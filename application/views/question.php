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
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Questions Overview</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Questions</th>
                                                    <th class="text-center">Question Type</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php $i = $this->uri->segment(3); foreach ($Questions as $Question) { $i++; ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $i; ?>.</td>
                                                        <td class="text-center"><?php echo $Question['question']; ?></td>
                                                        <td class="text-center"><?php echo $Question['question_type']; ?></td>

                                                        <td class="text-center">
                                                            <div class="row justify-content-center">
                                                                <a href="javascript:;" class="addAttr btn btn-info  float-right m-2" data-toggle="modal" data-target="#myModal" data-id="<?php echo $Question['id']; ?>" data-question="<?php echo $Question['question']; ?>" data-question_type="<?php echo $Question['question_type']; ?>"  > Edit</a>
                                                                <a href="javascript:;" class="addAtt btn btn-danger  float-right m-2" data-toggle="modal" data-target="#myModal1"  data-qid="<?php echo $Question['id']; ?>"  > Delete</a>
                                                			</div>
                                                		</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<script>
  $('.addAttr').click(function() {
  var id = $(this).data('id');
  var question = $(this).data('question');
  var question_type = $(this).data('question_type'); 
  
  $('#id').val(id); 
  $('#question').val(question);
  $('#question_type').val(question_type);
  } );
  
  $('.addAtt').click(function() {
  var qid = $(this).data('qid');

  $('#qid').val(qid); 
  } );
 </script>
 
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Question Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
            <?php echo form_open_multipart('admin/update_questions'); ?>
                <input type="hidden" class="form-control"  id="id" name="id" required>
                
                <label style="font-weight: 700;">Question</label>
                <div class="form-group mt-3" >
                    <input type="text" class="form-control"  id="question" name="question" required>
                </div>
                <label style="font-weight: 700;">Question Type</label>
                <div class="form-group mt-3" >
                <select name="question_type" id="question_type" class="form-control custom-select browser-default" >
                    <option value="text">Text</option>
                    <option value="date">Date Field</option>
                    <option value="url">Link Upload</option>
                    <option value="file">File Upload</option>
                    <option value="radio">Yes/No</option>
                </select>
                    <!-- <input type="text" class="form-control"  id="question_type" name="question_type" required> -->
                </div>
            
        </div>
           
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success" name="submit"  value="Change">    
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            <?php echo form_close(); ?>
      </div>
      
    </div>
  </div>
  
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Delete Question</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
            <?php echo form_open_multipart('admin/delete_questions'); ?>
                <input type="hidden" class="form-control"  id="qid" name="id" required>
                <P>Are you want delete this record?</P>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-danger" name="submit"  value="Delete">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        <?php echo form_close(); ?>
      </div>
      
    </div>
  </div>