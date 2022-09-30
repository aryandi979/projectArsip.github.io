<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("document/add");
$can_edit = ACL::is_allowed("document/edit");
$can_view = ACL::is_allowed("document/view");
$can_delete = ACL::is_allowed("document/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Document</h4>
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
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id_document']) ? urlencode($data['id_document']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_document">
                                        <th class="title"> Id Document: </th>
                                        <td class="value"> <?php echo $data['id_document']; ?></td>
                                    </tr>
                                    <tr  class="td-Nama_Berkas">
                                        <th class="title"><i class="fa fa-archive "></i> Nama Berkas: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Nama_Berkas']; ?>" 
                                                data-pk="<?php echo $data['id_document'] ?>" 
                                                data-url="<?php print_link("document/editfield/" . urlencode($data['id_document'])); ?>" 
                                                data-name="Nama_Berkas" 
                                                data-title="Enter Nama Berkas" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Nama_Berkas']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Tahun">
                                        <th class="title"><i class="fa fa-calendar-check-o "></i> Tahun: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Tahun']; ?>" 
                                                data-pk="<?php echo $data['id_document'] ?>" 
                                                data-url="<?php print_link("document/editfield/" . urlencode($data['id_document'])); ?>" 
                                                data-name="Tahun" 
                                                data-title="Enter Tahun" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Tahun']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Kodeklasifikasiid">
                                        <th class="title"><i class="fa fa-buysellads "></i> Kode klasifikasi: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/document_Kodeklasifikasiid_option_list'); ?>' 
                                                data-value="<?php echo $data['Kodeklasifikasiid']; ?>" 
                                                data-pk="<?php echo $data['id_document'] ?>" 
                                                data-url="<?php print_link("document/editfield/" . urlencode($data['id_document'])); ?>" 
                                                data-name="Kodeklasifikasiid" 
                                                data-title="Enter Kode klasifikasi" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Kodeklasifikasiid']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Aktif">
                                        <th class="title"><i class="fa fa-check-circle "></i> Aktif: </th>
                                        <td class="value"> <?php echo $data['Aktif']; ?></td>
                                    </tr>
                                    <tr  class="td-Inaktif">
                                        <th class="title"><i class="fa fa-times-circle "></i> Inaktif: </th>
                                        <td class="value"> <?php echo $data['Inaktif']; ?></td>
                                    </tr>
                                    <tr  class="td-Lokasi">
                                        <th class="title"><i class="fa fa-inbox "></i> Lokasi: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Lokasi']; ?>" 
                                                data-pk="<?php echo $data['id_document'] ?>" 
                                                data-url="<?php print_link("document/editfield/" . urlencode($data['id_document'])); ?>" 
                                                data-name="Lokasi" 
                                                data-title="Lokasi" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Lokasi']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-File">
                                        <th class="title"><i class="fa fa-file "></i> File: </th>
                                        <td class="value"><?php Html :: page_link_file($data['File']); ?></td>
                                    </tr>
                                    <tr  class="td-Ruangan">
                                        <th class="title"> Ruangan: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Ruangan']; ?>" 
                                                data-pk="<?php echo $data['id_document'] ?>" 
                                                data-url="<?php print_link("document/editfield/" . urlencode($data['id_document'])); ?>" 
                                                data-name="Ruangan" 
                                                data-title="Ruangan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Ruangan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Rak">
                                        <th class="title"> Rak: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Rak']; ?>" 
                                                data-pk="<?php echo $data['id_document'] ?>" 
                                                data-url="<?php print_link("document/editfield/" . urlencode($data['id_document'])); ?>" 
                                                data-name="Rak" 
                                                data-title="Rak" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Rak']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Dus">
                                        <th class="title"> Dus: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Dus']; ?>" 
                                                data-pk="<?php echo $data['id_document'] ?>" 
                                                data-url="<?php print_link("document/editfield/" . urlencode($data['id_document'])); ?>" 
                                                data-name="Dus" 
                                                data-title="Dus" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Dus']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Keterangan">
                                        <th class="title"> Keterangan: </th>
                                        <td class="value"> <?php echo $data['Keterangan']; ?></td>
                                    </tr>
                                    <tr  class="td-Tanggal">
                                        <th class="title"> Tanggal: </th>
                                        <td class="value"> <?php echo $data['Tanggal']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("document/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("document/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
