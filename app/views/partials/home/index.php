<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 > OJK NTB E-arsip </h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="page-header"><h4>Arsip Hari ini</h4></div>
            <div class="row justify-content-start">
                <div class="col-md-12 comp-grid">
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_arsipsebelumnya();  ?>
                    <a class="animated zoomIn record-count card bg-secondary text-white">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-archive fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Arsip Sebelumnya</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_arsipupdate();  ?>
                    <a class="animated zoomIn record-count card bg-success text-white">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-plus-square fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Arsip Update</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_totalarsip();  ?>
                    <a class="animated zoomIn record-count card bg-warning text-white">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-server fa-3x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Total Arsip</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
