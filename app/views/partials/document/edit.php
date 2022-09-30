<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit  Document</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("document/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="Nama_Berkas">Nama Berkas <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-Nama_Berkas"  value="<?php  echo $data['Nama_Berkas']; ?>" type="text" placeholder="Enter Nama Berkas"  required="" name="Nama_Berkas"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="Tahun">Tahun <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input id="ctrl-Tahun"  value="<?php  echo $data['Tahun']; ?>" type="number" placeholder="Enter Tahun" step="1"  required="" name="Tahun"  class="form-control " />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-calendar "></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="Kodeklasifikasiid">Kode klasifikasi <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-Kodeklasifikasiid"  value="<?php  echo $data['Kodeklasifikasiid']; ?>" type="text" placeholder="Enter Kode klasifikasi" list="Kodeklasifikasiid_list"  required="" name="Kodeklasifikasiid"  class="form-control " />
                                                            <datalist id="Kodeklasifikasiid_list">
                                                                <?php 
                                                                $Kodeklasifikasiid_options = $comp_model -> document_Kodeklasifikasiid_option_list();
                                                                if(!empty($Kodeklasifikasiid_options)){
                                                                foreach($Kodeklasifikasiid_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                ?>
                                                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                                <?php
                                                                }
                                                                }
                                                                ?>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" > </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-Ruangan"  value="<?php  echo $data['Ruangan']; ?>" type="text" placeholder="Ruangan"  name="Ruangan"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" > </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-Rak"  value="<?php  echo $data['Rak']; ?>" type="text" placeholder="Rak"  name="Rak"  class="form-control " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" > </label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-Dus"  value="<?php  echo $data['Dus']; ?>" type="text" placeholder="Dus"  name="Dus"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="Lokasi">Lokasi </label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-Lokasi"  value="<?php  echo $data['Lokasi']; ?>" type="text" placeholder="Lokasi"  readonly name="Lokasi"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="File">File <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <div class="dropzone required" input="#ctrl-File" fieldname="File"    data-multiple="false" dropmsg="Choose files to upload"    btntext="Browse" filesize="3000" maximum="50">
                                                                                <input name="File" id="ctrl-File" required="" class="dropzone-input form-control" value="<?php  echo $data['File']; ?>" type="text"  />
                                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                                                </div>
                                                                            </div>
                                                                            <?php Html :: uploaded_files_list($data['File'], '#ctrl-File', 'true'); ?>
                                                                            <small class="form-text">*Penamaan file harus menggunakan tanda "_" sebagai pengganti spasi</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-ajax-status"></div>
                                                            <div class="form-group text-center">
                                                                <button class="btn btn-primary" type="submit">
                                                                    Update
                                                                    <i class="fa fa-send"></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
