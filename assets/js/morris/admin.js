/*
'use strict';

// VARIABLES
var id;
var lmedia;
var conversation;
var conversationsClient;
var fid;
var firebase;
var disconnected = false;

// CHECK IF A WEBRTC BROWSER
if (!navigator.webkitGetUserMedia && !navigator.mozGetUserMedia) {
  tlog('You are using a browser that is not WebRTC compatible, please use Google Chrome or Mozilla Firefox</div>', true);
}

// GET TWILIO TOKEN AND ACCESS TO CONVERSATION
$('#start').on('click', function() {
  if ($('#id').val() == '') {
    tlog('Please enter a name to view streaming</div>', true);
  } else {
    id = $('#id').val().replace(/\s+/g, '');
    $.ajax({
      type: 'GET',
      url: '/online_video/stream/token.php',
      data: {
        id: $('#id').val()
      },
      dataType: "json",
      success: function(data) {
        var accessManager = new Twilio.AccessManager(data.token);
        conversationsClient = new Twilio.Conversations.Client(accessManager);
        conversationsClient.listen().then(clientConnected, function(e) {
          tlog('Could not connect to Twilio: ' + e.message + ' </div>', true);
        });
      }
    });
  }
});

// SUCCESSFULLY CONNECTED TO TWILIO CONVERSATION
function clientConnected() {
  firebaseConnect();
  $('#id, #start').hide();
  $('#disconnect').fadeIn();
  $('#status').css({
    'color': '#5E9F21'
  }).text('CONNECTED');
  tlog('You have succussfully connected <strong>' + id + '</strong>.');
  if (!lmedia) {
    startConversation();
  };
  conversationInvite();
}

// CONNECT TO FIREBASE
  function firebaseConnect(){
    var fburl = 'https://first-video.firebaseio.com';
    firebase = new Firebase(fburl + '/users');
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

// TWILIO GET ACCESS TO CAMERA & MICROPHONE
function startConversation() {
  lmedia = new Twilio.Conversations.LocalMedia();
  Twilio.Conversations.getUserMedia().then(function(mediaStream) {
    lmedia.addStream(mediaStream);
    lmedia.attach('#lstream');
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
  tlog('We are waiting on your assessor to connect...');
  participantConnected();
  participantDisconnected();
}

// TWILIO PARICIPANT CONNECTED
function participantConnected() {
  conversation.on('participantConnected', function(participant) {
    new Firebase(fid).remove();
    participant.media.attach('#rstream');
    tlog('You are viewing: <strong>' + participant.identity + '</strong>');
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
    tlog('<strong>' + participant.identity + '</strong> has stoped streamin.');
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
    tlog('Please rejoin the server to view.');
  }
}

// FIREBASE ADD PARTICIPANT
function addParticipant(child) {
  if (child.val() != id) {
    $('.users-list').append('<div class="user ' + child.val() + '"><span>' + child.val() + '</span><button class="b-connect" id="' + child.val() + '">View Now</button></div>');
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
*/
var d = new Date();
var n = d.getTime();
var id = n;
var lmedia;
var conversation;
var conversationsClient;
var fid;
var firebase;
var disconnected = false;
var dataConnection;
var mode = 'environment';
var constraint = {audio: true, video: true};
var videosContainer = document.getElementById('videos-container');
    
    


    // Compatibility shim
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

    // PeerJS object
    var peer = new Peer(id,{ 
                           key: '67f9e568-6389-45a2-99a7-718ea2ab5662',
                         config: {'iceServers': [
		                       {url:'stun:stun01.sipphone.com'},
                               {url:'stun:stun.ekiga.net'},
                               {url:'stun:stun.fwdnet.net'},
                               {url:'stun:stun.ideasip.com'},
                               {url:'stun:stun.iptel.org'},
                               {url:'stun:stun.rixtelecom.se'},
                               {url:'stun:stun.schlund.de'},
                               {url:'stun:stun.l.google.com:19302'},
                               {url:'stun:stun1.l.google.com:19302'},
                               {url:'stun:stun2.l.google.com:19302'},
                               {url:'stun:stun3.l.google.com:19302'},
                               {url:'stun:stun4.l.google.com:19302'},
                               {url:'stun:stunserver.org'},
                               {url:'stun:stun.softjoys.com'},
                               {url:'stun:stun.voiparound.com'},
                               {url:'stun:stun.voipbuster.com'},
                               {url:'stun:stun.voipstunt.com'},
                               {url:'stun:stun.voxgratia.org'},
                               {url:'stun:stun.xten.com'},
                               {
                                   url: 'turn:192.158.29.39:3478?transport=udp',
                                   credential: 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
                                   username: '28224511:1379330808'
                               },
                               {
                                   url: 'turn:192.158.29.39:3478?transport=tcp',
                                   credential: 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
                                   username: '28224511:1379330808'
                               },
		                       { url: 'turn:numb.viagenie.ca', credential: 'muazkh', username: 'webrtc@live.com' }
        		         ]}
                        });
    
    
    peer.on('open', function(){
        firebaseConnect();
    });

function firebaseConnect(){
    var fburl = 'https://first-video.firebaseio.com';
    firebase = new Firebase(fburl + '/users');
   // firebase.remove();
   // var uid = firebase.push(id);
    //var uid = firebase.push();
   // uid.set({ 'id': id, 'text': localStorageService.get('type') });
   // fid = uid.toString();
   // new Firebase(fid).onDisconnect().remove();
    
    firebase.on('child_added', function(child) {
       
      addParticipant(child);
        
    });
    firebase.on('child_removed', function(child) {
      $('.' + child.val()).remove();
    });
  }
    // Receiving a call
    peer.on('call', function(call){
      // Answer the call automatically (instead of prompting user) for demo purposes
      call.answer(window.localStream);
      step3(call);
    });
    peer.on('error', function(err){
      // alert(err.message);
        console.log(err.message);
      // Return to step 2 if error occurs
      step2();
    });
        
        
        
        function step1 () {
      // Get audio/video stream
            
      navigator.getUserMedia(constraint, function(stream){
        // Set your video displays
          console.log(constraint);
        $('#my-video').prop('src', URL.createObjectURL(stream));

        window.localStream = stream;
        step4();
      }, function(){ $('#step1-error').show(); });
    }

    function step2 () {
        
      $('#step1, #step3').hide();
      $('#step2').show();
        if (!disconnected) {
     // var uid = firebase.push(peer.id);
     // fid = uid.toString();
       
    //  new Firebase(fid).onDisconnect().remove();
    }
    $('.user-list').empty();
    if (firebase) {
      firebase.once('child_added', function(child) {
        addParticipant(child);
          console.log(child);
      });
    }
    }
        
        function step4 () {
        
      $('#step1, #step3').hide();
      $('#step2').show();
    }

    function step3 (call) {
      // Hang up on an existing call if present
      if (window.existingCall) {
        window.existingCall.close();
      }
     
      // Wait for stream on the call, then set peer video display
      call.on('stream', function(stream){
        $('#their-video').prop('src', URL.createObjectURL(stream));
      });

      // UI stuff
      window.existingCall = call;
      $('#their-id').text(call.peer);
      call.on('close', step2);
      $('#step1, #step2').hide();
      $('#step3').show();
    }
      
function addParticipant(child) {
 if (child.val() != id) {
    $('.user-list').append('<a class="user ' + child.val() + ' item item-text-wrap b-connect" id="' + child.val() + '">Live view ' + child.val() + '</a>');
  }
}
        $(function(){
        $(".user-list").on('click', '.b-connect', function () {
        // Initiate a call!
           // var user = $(this).attr('id');
        var call = peer.call($(this).attr('id'), window.localStream);
        step3(call);
      });

      $('#end-call').click(function(){
        window.existingCall.close();
          $('#their-video').prop('src', 'none');
         // new Firebase(fid).remove();
         step2();
      });

      // Retry if getUserMedia fails
      $('#step1-retry').click(function(){
        $('#step1-error').hide();
        step1();
      });

      // Get things started
      step1();
    });
