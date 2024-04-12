<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SESSION['username']) {
	redirect('admin','refresh');
}
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Questions</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Answer Questions</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <?php echo form_open_multipart('admin/answer_question'); ?>
                                            <?php  foreach ($Questions as $Question) {  ?>
                                            <div class="form-group row">
                                                <?php if($Question['question_type'] == "file"){?>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user" name="question_file[]" id="Question" value="<?php echo $Question['question']; ?>"
                                                            placeholder="Question" readonly>
                                                            
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control form-control-user" name="question[]" id="Question" value="<?php echo $Question['question']; ?>"
                                                            placeholder="Question" readonly>
                                                               
                                                    </div>
                                                <?php } ?>
                                                
                                                <?php if($Question['question_type'] == "radio"){?>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="radio" id="question_type1" name="answer_type[]" value="Yes">
                                                    <label for="question_type1">Yes</label>
                                                    <input type="radio" id="question_type2" name="answer_type[]" value="No">
                                                    <label for="question_type2">No</label><br>
                                                </div>
                                                
                                                <?php }elseif($Question['question_type'] == "file"){ ?>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="<?php echo $Question['question_type']; ?>" class="form-control form-control-user" name="file[]"  
                                                        placeholder="Answer the Question" required accept=".docx,.doc,.pdf">
                                                    </div>
                                                <?php }elseif($Question['question_type'] == "url"){ ?>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="<?php echo $Question['question_type']; ?>" class="form-control form-control-user" name="answer_type[]"  value=""
                                                        placeholder="Enter the Url" required>   
                                                    </div>
                                                <?php }else{ ?>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="<?php echo $Question['question_type']; ?>" class="form-control form-control-user" name="answer_type[]"  value=""
                                                        placeholder="Answer the Question" required>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                            <input type="submit" style="border-radius:2rem;" class="btn btn-primary btn-user btn-block" name="submit" value="Submit">
                                            <hr>
                                            
                                         <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            
 