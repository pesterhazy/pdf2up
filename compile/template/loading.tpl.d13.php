<?php
ob_start(); /* template body */ ?><div id="content"></div>

<script type="text/javascript">

    YAHOO.namespace("example.container");

    function gotoResults() {
        window.location = window.location.protocol + "//" +
            location.host + window.location.pathname + "?do=result";
    }

    function init() {
        var content = document.getElementById("content");
        content.innerHTML = "";
        if (!YAHOO.example.container.wait) {
            // Initialize the temporary Panel to display while waiting for external content to load
            YAHOO.example.container.wait = 
                    new YAHOO.widget.Panel("wait",  
                                                    { width: "240px", 
                                                      fixedcenter: true, 
                                                      close: false, 
                                                      draggable: false, 
                                                      zindex:4,
                                                      modal: true,
                                                      visible: false
                                                    } 
                                                );
    
            YAHOO.example.container.wait.setHeader("Loading, please wait...");
            YAHOO.example.container.wait.setBody("<img src=\"http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif\"/>");
            YAHOO.example.container.wait.render(document.body);

        }
    
        // Show the Panel
        YAHOO.example.container.wait.show();

        callServer();
        this.countCalls = 0;
        this.callInterval = window.setInterval(callServer, 500);
    }

    function callServer() {
        var callback = {
            success : function(o) {
                if ( o.responseText == "done" ) {
                    window.clearInterval(this.callInterval);
                    gotoResults();
                }
            },
            failure : function(o) {
                // AJAX connection failed

                window.clearInterval(this.callInterval);
                gotoResults();
            },
            timeout : 1000
        }
        var MAX_CALLS = 1000;

        this.countCalls += 1;

        if ( this.countCalls >= MAX_CALLS ) {
            window.clearInterval(this.callInterval);
            gotoResults();
        }
        else {
            YAHOO.util.Connect.asyncRequest("GET", "index.php?do=doneyet&uuid=<?php echo $this->scope["uuid"];?>&r=" + new Date().getTime(), callback);
        }
    }
    
    YAHOO.util.Event.onDOMReady(init); 
</script>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>