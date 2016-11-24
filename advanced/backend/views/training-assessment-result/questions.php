<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Monthly Assessment';
$this->miniTitle = 'Assessment Module';
$this->subTitle = 'Assessment Form';

$this->params['breadcrumbs'][] = $this->title;

$estimatedTime = (int) ($modelTrainingAssessMentCategory->estimated_time * 60);
$estimatedTimeSeconds = $estimatedTime * 1000;

$action = \yii\helpers\Url::base() . '/index.php/training-assessment-result/result';

?>

<div class="training-assessment-question-form">
    
    <div class="row">
        <div class="col-sm-3 col-sm-offset-4" style="padding-left:70px">
            <div class="alert alert-danger">
                <div id='timer'>
                    <script type="application/javascript">
                        var myCountdownTest = new Countdown({
                            time: <?= $estimatedTime; ?>,
                            width:200, 
                            height:80, 
                            rangeHi:"minute"
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <form class="form-horizontal" role="form" id='login' method="post" action="<?= $action; ?>">
                                    
        <?php 
        $i=1;
        foreach($modelTrainingAssessMentQuestions as $question) {

            if($i==1) { ?>

                <div id='question<?php echo $i;?>' class="cont">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 id="qname<?php echo $i;?>" class="questions panel-title">
                                <?php echo $i?>. <?php echo $question->question_name; ?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <p><b>Answer</b></p>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="1" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/> <?php echo $question->answer1;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="2" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/> <?php echo $question->answer2;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="3" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/> <?php echo $question->answer3;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="4" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/> <?php echo $question->answer4;?>
                                </label>
                            </div>

                            <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/>                                                                      
                            <br/>
                            <button id='<?php echo $i;?>' class='next btn btn-success' type='button'>Next</button>
                        </div>   
                    </div> 
                </div> 

            <?php } elseif($i < 1 || $i < $totalQuestion){ ?>

                <div id='question<?php echo $i;?>' class="cont">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 id="qname<?php echo $i;?>" class="questions panel-title">
                                <?php echo $i?>. <?php echo $question->question_name; ?>
                            </h3>
                        </div>
                        <div class="panel-body">

                            <p><b>Answer</b></p>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="1" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/><?php echo $question->answer1;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="2" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/><?php echo $question->answer2;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="3" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/><?php echo $question->answer3;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="4" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/><?php echo $question->answer4;?>
                                </label>
                            </div>

                            <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/>                                                                      
                            <br/>
                            <button id='<?php echo $i;?>' class='next btn btn-success' type='button'>Next</button>
                        </div>   
                    </div> 
                </div> 


            <?php }elseif($i == $totalQuestion){?>

                <div id='question<?php echo $i;?>' class="cont">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 id="qname<?php echo $i;?>" class="questions panel-title">
                                <?php echo $i?>. <?php echo $question->question_name; ?>
                            </h3>
                        </div>
                        <div class="panel-body">

                            <div class="radio">
                                <label>
                                    <input type="radio" value="1" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/><?php echo $question->answer1;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="2" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/><?php echo $question->answer2;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="3" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/><?php echo $question->answer3;?>
                                </label>
                            </div>

                            <div class="radio">
                                <label>
                                    <input type="radio" value="4" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/><?php echo $question->answer4;?>
                                </label>
                            </div>

                            <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $question->id;?>' name='<?php echo $question->id;?>'/>                                                                      
                            <br/>

                            <button id='<?php echo $i;?>' class='next btn btn-success' type='submit'>Finish</button>
                        </div>   
                    </div> 
                </div> 

        <?php } $i++;} ?>
    </form>

</div>

<?php 

$js = <<< JS
    $(document).ready(function(){

    $(".cont").addClass("hide");
        count=$(".questions").length;
         $("#question"+1).removeClass("hide");

         $(document).on("click",".next", function(){
             last=parseInt($(this).attr("id"));     
             nex=last+1;
             $("#question"+last).addClass("hide");

             $("#question"+nex).removeClass("hide");
         });

         $(document).on("click",".previous",function(){
             last=parseInt($(this).attr("id"));     
             pre=last-1;
             $("#question"+last).addClass("hide");

             $("#question"+pre).removeClass("hide");
         });

         setTimeout(function() {
             $("form").submit();
          }, $estimatedTimeSeconds);

});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);

$this->registerJsFile(Yii::$app->assetManager->getPublishedUrl('@bower/backend/') . '/dist/js/countdown.js', ['position' => \yii\web\View::POS_HEAD]);