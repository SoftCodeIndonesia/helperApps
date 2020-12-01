<div class="row">
    <input type="hidden" id="nama" value="<?= $_SESSION['name'] ?>">
    <div class="col-sm-12 text-center pl-4 pt-4 pr-4">
        <div class="mapouter">
            <div class="gmap_canvas">
            
                <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=<?= $_SESSION['lat'] . ',' . $_SESSION['lng'] ?>&t=k&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                
                <a href="https://embedgooglemap.net/134/"></a>
                
            </div>
            
            <style>
            
                .mapouter{
                    position:relative;
                    text-align:right;
                    height:300%;
                    width:100%;
                }
                
                .gmap_canvas {
                    overflow:hidden;
                    background:none
                    !important;
                    height:100%;
                    width:100%;
            }
            </style>
        </div>
    </div>
</div>