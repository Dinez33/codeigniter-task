<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SESSION['username'] && $_SESSION['user_role'] != 1) {
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
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Create Questions</h6>
                                        <button class="btn btn-primary btn-user btn-block add_field_button" style="width: auto;">Add More Fields</button>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <?php echo form_open_multipart('admin/add_question'); ?>
                                            <div class="form-group row input_fields_wrap">
                                                <div class="col-sm-5 mb-3 ">
                                                    <input type="text" class="form-control form-control-user" name="question[]" id="Question"
                                                        placeholder="Question" required>
                                                </div>
                                                <div class="col-sm-5 mb-3 ">
                                                	  <select name="question_type[]" class="form-control custom-select browser-default" >
                                                		  <option value="text">Text</option>
                                                          <option value="date">Date Field</option>
                                                          <option value="url">Link Upload</option>
                                                          <option value="file">File Upload</option>
                                                          <option value="radio">Yes/No</option>
                                                	  </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <input type="submit" style="border-radius:2rem;" class="btn btn-primary btn-user btn-block" name="submit" value="Create Question">
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
            <script>
                $(document).ready(function() {
                var max_fields      = 10; //maximum input boxes allowed
                var wrapper         = $(".input_fields_wrap"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="col-lg-12"> <div class="form-group row"><div class="col-lg-5 mb-3 mb-sm-0"><input type="text" class="form-control form-control-user" name="question[]" id="Question" placeholder="Question" required></div><div class="col-lg-5 mb-3 mb-sm-0"><select name="question_type[]" class="form-control custom-select browser-default" ><option value="text">Text</option><option value="date">Date Field</option> <option value="url">Link Upload</option><option value="file">File Upload</option><option value="radio">Yes/No</option> </select></div> <a href="#" class="remove_field">Remove</a> </div></div>'); // add input boxes.
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                })
            });
            </script>
 