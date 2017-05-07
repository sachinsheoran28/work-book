/*
*  Copyright (c) 2015 The WebRTC project authors. All Rights Reserved.
*
*  Use of this source code is governed by a BSD-style license
*  that can be found in the LICENSE file in the root of the source
*  tree.
*/

'use strict';

var videoEle = document.querySelector('.recordrtc video');
var videoSec = document.querySelector('select#videoSource');
var selectorsc = [videoSec];

function gotDev(deviceInfos) {
  // Handles being called several times to update labels. Preserve values.
  var values = selectorsc.map(function(select) {
    return select.value;
  });
  selectorsc.forEach(function(select) {
    while (select.firstChild) {
      select.removeChild(select.firstChild);
    }
  });
  for (var i = 0; i !== deviceInfos.length; ++i) {
    var deviceInfo = deviceInfos[i];
    var option = document.createElement('option');
    option.value = deviceInfo.deviceId;
    if (deviceInfo.kind === 'videoinput') {
      option.text = 'camera ' + (videoSec.length + 1);
      videoSec.appendChild(option);
    } else {
      console.log('Some other kind of source/device: ', deviceInfo);
    }
  }
  selectorsc.forEach(function(select, selectorIndex) {
    if (Array.prototype.slice.call(select.childNodes).some(function(n) {
      return n.value === values[selectorIndex];
    })) {
      select.value = values[selectorIndex];
    }
  });
}

navigator.mediaDevices.enumerateDevices().then(gotDev).catch(handleErr);



function gotStr(stream) {
  window.stream = stream; // make stream available to console
  videoEle.srcObject = stream;
  // Refresh button list in case labels have become available
  return navigator.mediaDevices.enumerateDevices();
}

function star() {
  if (window.stream) {
    window.stream.getTracks().forEach(function(track) {
      track.stop();
    });
  }
  var videoSource = videoSec.value;
  var constraints = {
    video: {deviceId: videoSource ? {exact: videoSource} : undefined}
  };
  navigator.mediaDevices.getUserMedia(constraints).
      then(gotStr).then(gotDev).catch(handleErr);
}

videoSec.onchange = star;

star();

function handleErr(error) {
  console.log('navigator.getUserMedia error: ', error);
}