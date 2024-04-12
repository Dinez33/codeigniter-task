<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!$_SESSION['username'] && $_SESSION['user_role'] != 2) {
	redirect('admin','refresh');
}
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Answers</h1>
                    </div>


                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Answers Overview</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">S.No</th>
                                                    <th class="text-center">Questions</th>
                                                    <th class="text-center">Answers</th>
                                                    <!-- <th class="text-center">Action</th> -->
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php $i = $this->uri->segment(3); foreach ($Answers as $Answer) { $i++; ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $i; ?>.</td>
                                                        <td class="text-center"><?php echo $Answer['question']; ?></td>
                                                        <?php if($Answer['answer_type'] == 'url'){?>
                                                            <td class="text-center">
                                                                <div class="row justify-content-center">
                                                                    <a href="<?php echo $Answer['answer']; ?>" target="_blank" class="addAttr btn btn-info  float-right m-2">View</a>
                                                                </div>
                                                            </td>
                                                        <?php }elseif( $Answer['answer_type'] == 'file'){ ?>
                                                            <td class="text-center">
                                                                <div class="row justify-content-center">
                                                                    <a href="<?php echo $Answer['answer']; ?>" target="_blank" class="addAttr btn btn-info  float-right m-2">View</a>
                                                                </div>
                                                            </td>
                                                        <?php }else{ ?>    
                                                            <td class="text-center"><?php echo $Answer['answer']; ?></td>
                                                        <?php } ?>
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
