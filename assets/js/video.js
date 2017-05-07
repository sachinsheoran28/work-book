'use strict';

// VARIABLES
var id;
var lmedia;
var conversation;
var conversationsClient;
var fid;
var firebase;
var videoSource;
var disconnected = false;


var videoSelect = document.querySelector('select#videoSource');
var selectors = [videoSelect];



// CHECK IF A WEBRTC BROWSER
if (!navigator.webkitGetUserMedia && !navigator.mozGetUserMedia) {
  tlog('You are using a browser that is not WebRTC compatible, please use Google Chrome or Mozilla Firefox</div>', true);
}



// GET TWILIO TOKEN AND ACCESS TO CONVERSATION
$('#start').on('click', function() {
  if ($('#id').val() == '') {
    tlog('Please enter a name to start streaming</div>', true);
  } else {
    id = $('#id').val().replace(/\s+/g, '');
    $.ajax({
      type: 'GET',
      url: 'http://www.mcd.glocalthinkers.in/stream/token.php',
      data: {
        id: $('#id').val()
      },
      dataType: "json",
      success: function(data) {
        var accessManager = new Twilio.AccessManager(data.token);
        conversationsClient = new Twilio.Conversations.Client(accessManager);
        conversationsClient.listen().then(clientConnected, function(e) {
          tlog('Could not connect to Server: ' + e.message + ' </div>', true);
        });
      }
    });
  }
});

// Get cameras 
function gotDevices(deviceInfos) {
  // Handles being called several times to update labels. Preserve values.
  var values = selectors.map(function(select) {
    return select.value;
  });
  selectors.forEach(function(select) {
    while (select.firstChild) {
      select.removeChild(select.firstChild);
    }
  });
  for (var i = 0; i !== deviceInfos.length; ++i) {
    var deviceInfo = deviceInfos[i];
    var option = document.createElement('option');
    option.value = deviceInfo.deviceId;
    if (deviceInfo.kind === 'videoinput') {
      option.text = 'camera ' + (videoSelect.length + 1);
      videoSelect.appendChild(option);
    } else {
      console.log('Some other kind of source/device: ', deviceInfo);
    }
  }
  selectors.forEach(function(select, selectorIndex) {
    if (Array.prototype.slice.call(select.childNodes).some(function(n) {
      return n.value === values[selectorIndex];
    })) {
      select.value = values[selectorIndex];
    }
  });
}

navigator.mediaDevices.enumerateDevices().then(gotDevices).catch(handleError);

// SUCCESSFULLY CONNECTED TO TWILIO CONVERSATION
function clientConnected() {
  firebaseConnect();
  $('#id, #start').hide();
  $('#disconnect').fadeIn();
  $('#status').css({
    'color': '#5E9F21'
  }).text('CONNECTED');
  tlog('You have succussfully started streaming</strong>.');
  if (!lmedia) {
    startConversation();
  };
  conversationInvite();
}

// CONNECT TO FIREBASE
  function firebaseConnect(){
    var fburl = 'https://first-video.firebaseio.com';
      
    firebase = new Firebase(fburl + '/users');
      // firebase.remove();
    var uid = firebase.push(id);
    fid = uid.toString();
    new Firebase(fid).onDisconnect().remove();
    firebase.on('child_added', function(child) {
      addParticipant(child);
    });
    firebase.on('child_removed', function(child) {
      $('.' + child.val()).remove();
    });
  }



/////////////////////////////
function gotStream(mediaStream) {
  window.stream = mediaStream; // make stream available to console
  lmedia.srcObject = mediaStream;
  // Refresh button list in case labels have become available
  return navigator.mediaDevices.enumerateDevices();
}

/////////////////////////////

videoSelect.onchange = vidChange;
function vidChange() {
  videoSource = videoSelect.value;
    return videoSource
}

// TWILIO GET ACCESS TO CAMERA & MICROPHONE
function startConversation() {
  //videoSource = videoSelect.value;
    vidChange();
  var constraints = {
      audio: true,
      video: {deviceId: videoSource ? {exact: videoSource} : undefined}
  };
    console.log(videoSource);
    console.log(constraints);
  lmedia = new Twilio.Conversations.LocalMedia();
    
  Twilio.Conversations.getUserMedia(constraints).then(function(mediaStream) {
      console.log(mediaStream);
      gotStream();
    lmedia.addStream(mediaStream);
    //lmedia.addStream(gotStream());
      
       window.mediaStream = mediaStream;
    lmedia.attach('#lstream');
  // Refresh button list in case labels have become available
      
      $( "#startrec" ).click();
  }, function(e) {
    tlog('We were unable to access your Camera and Microphone.');
  });
}

// TWILIO INVITE TO CONVERSTATION
function conversationInvite() {
  conversationsClient.on('invite', function(invite) {
    invite.accept().then(conversationStarted);
    tlog('You have a incoming invite from: <strong>' + invite.from + '</strong>');
  });
}

// CONNECT TO A USER IN THE CHATROOM
$(document).on('click', '.b-connect', function() {
  var user = $(this).attr('id');
  var options = {};
  options.localMedia = lmedia;
  conversationsClient.inviteToConversation(user, options).then(conversationStarted, function(error) {
    tlog('We were unable to create the chat conversation with that user, try another online user.', true);
  });
});

// TWILIO CONVERSTATION STARTED
function conversationStarted(convo) {
  conversation = convo;
  tlog('We are waiting on your friend to connect...');
  participantConnected();
  participantDisconnected();
}

// TWILIO PARICIPANT CONNECTED
function participantConnected() {
  conversation.on('participantConnected', function(participant) {
    new Firebase(fid).remove();
    participant.media.attach('#rstream');
    tlog('You are vied by: <strong>' + participant.identity + '</strong>');
  });
}

// TWILIO PARICIPANT DISCONNETED
function participantDisconnected() {
  conversation.on('participantDisconnected', function(participant) {
    if (!disconnected) {
      var uid = firebase.push(id);
      fid = uid.toString();
       
      new Firebase(fid).onDisconnect().remove();
    }
    $('.' + participant.identity).remove();
    tlog('<strong>' + participant.identity + '</strong> has disconnected from this stream.');
    $('.users-list').empty();
    if (firebase) {
      firebase.once('child_added', function(child) {
        addParticipant(child);
      });
    }
  });
}

// DISCONNECT FROM TWILIO CONVERSATION
$('#disconnect').on('click', function() {
    
    
    $("#startrec").click();
  new Firebase(fid).remove();
  firebase.off();
  firebase = null;
  disconnected = true;
  $('#disconnect').hide();
  $('#start, #id').fadeIn();
  $('#status').css({
    'color': ''
  }).text('DISCONNETED');
  $('.users-list').empty();
    
    
  stopConversation();
});

// TWILIO STOP CONVERSTATION
function stopConversation() {
  if (conversation) {
      
    conversation.disconnect();
    conversationsClient = null;
    conversation = null;
    lmedia.stop();
    lmedia = null;
     
    tlog('You have successfully disconnected from this chat conversation, start another one now.');
  } else {
    lmedia.stop();
    lmedia = null;
    tlog('Please rejoin the chatroom to start a conversation.');
  }
}

// FIREBASE ADD PARTICIPANT
function addParticipant(child) {
  if (child.val() != id) {
    $('.users-list').append('<div class="user ' + child.val() + '"><span>' + child.val() + '</span><button class="b-connect" id="' + child.val() + '">Call Now</button></div>');
  }
}

// LOGS
function tlog(msg, e) {
  if (e) {
    $('.logs').append('<div class="log error">' + msg + '</div>');
  } else {
    $('.logs').append('<div class="log">' + msg + '</div>');
  }
}
function handleError(error) {
  console.log('navigator.getUserMedia error: ', error);
}
