<?php $this->load->view('admin/vwHeader'); ?>
<div class="home">
    <div class="m-content">
        <h1>View real time video</h1>
        <div class="start">
            <input type="hidden" id="id" name="id" value="<?php echo $this->session->userdata['username'] ?>" />
        </div>
        <div class="remote">
            <div class="card" id="video-container">
                <video id="their-video" autoplay></video>
                <video style="display:none" id="my-video" muted="true" autoplay></video>
            </div>
            <div id="rstream"></div>
            <div id="lstream" style="display:none; opacity:0; visibility:hidden; position: absolute; top:-9999px"></div>
        </div>
        <div id="step1">
            <p>Please click `allow` on the top of the screen so we can access your webcam and microphone for calls.</p>
            <div id="step1-error">
                <p>Failed to access the webcam and microphone. Make sure to run this demo on an http server and click allow when asked for permission by the browser.</p>
                <a href="#" class="btn btn-warning" id="step1-retry">Try again</a>
            </div>
        </div>
        <div id="step2" class="item item-text-wrap">
        </div>
        <div id="step3" class="item item-text-wrap">
            <p>Currently you are watching <span id="their-id">...</span></p>
            <p><a href="" class="btn btn-danger" id="end-call">End call</a></p>
        </div>
        <div class="user-list"></div>
        <div class="logs"></div>
    </div>
</div>
<!-- Script src = "https://skyway.io/dist/0.3/peer.js"> </ script -->

<!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
<script src="<?php echo HTTP_JS_PATH; ?>peer.min.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>getMediaElement.js"></script>

<!-- for Edige/FF/Chrome/Opera/etc. getUserMedia support -->
<script src="https://cdn.webrtc-experiment.com/gumadapter.js"></script>
<script src="<?php echo HTTP_JS_PATH; ?>firebase.js"></script>	

<script src="<?php echo HTTP_JS_PATH; ?>admin.js"></script>

<?php $this->load->view('admin/vwFooter'); ?>