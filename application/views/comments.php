     
       <div class="row">
            <div class="span3"> </div>
            <div class="span6"> 
            <h1>Thanks for your feedback!</h1>
            <h4> You are 1 step away from submitting your feedback</h4>
            <? if($ranking == "Yes"){ ?>

            <h4>Please help us improve by letting us know what we did well and what we could do better next time. It only takes a minute!</h4>
            <? }else{ ?>
            <h4>Help us improve by letting us know what we could have done better.  We are always trying to improve!</h4>
            <? }; ?>
            
            
            
                <form class="form-horizontal" action="/joy/comment" method="post">
                    <textarea id="comments" rows="8" style="width:100%;" name="comment"></textarea>
                    <br>
                    <div style="margin: 0px auto; width: 100%;">
                   		<button id="buttonsubmit" class="btn btn-large btn-block btn-success" type="submit" >Submit your Feedback</button>
                    </div>
                    <input type="hidden" value="<? echo $subdomain ;?>" name="subdomain">
                    <input type="hidden" value="<? echo $case ;?>" name="case">
                    <input type="hidden" value="<? echo $agent ;?>" name="agent">
                    <input type="hidden" value="<? echo $user_id ;?>" name="user_id">
                    <input type="hidden" value="<? echo $ranking ;?>" name="ranking">
                    <input type="hidden" value="<? echo $status ;?>" name="status">
                    
                </form>
            
            </div>
            <div class="span3"> </div>
        </div>
