@extends('admin.layouts.main')


@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4><?= $_title ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <form method="post" action="{{ CommonHelper::admin('settings') }}" enctype="multipart/form-data">
         {{ csrf_field() }}

            <div class="card">
                <div class="card-header">
                    <h5>App Settings</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>App Name <span class="-req">*</span></label>
                                <input name="app_name" type="text" class="form-control" value="<?= CommonHelper::setting('app_name') ?>" placeholder="App Name" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="card">
                <div class="card-header">
                    <h5>Test Settings</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input name="test_mobile" type="text" class="form-control" value="<?= CommonHelper::setting('test_mobile') ?>" placeholder="Mobile">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="test_email" type="text" class="form-control" value="<?= CommonHelper::setting('test_email') ?>" placeholder="Email">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Magic SMS</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apikey<span class="-req">*</span></label>
                                <input name="third_party_magicsms_apikey" type="text" class="form-control" value="<?= CommonHelper::setting('third_party_magicsms_apikey') ?>" placeholder="Apikey" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sender ID<span class="-req">*</span></label>
                                <input name="third_party_magicsms_senderid" type="text" class="form-control" value="<?= CommonHelper::setting('third_party_magicsms_senderid') ?>" placeholder="Sender ID" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>WhatsApp 11Za</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Authtoken<span class="-req">*</span></label>
                                <input name="third_party_wp_11za_authtoken" type="text" class="form-control" value="<?= CommonHelper::setting('third_party_wp_11za_authtoken') ?>" placeholder="Authtoken" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Origin Website<span class="-req">*</span></label>
                                <input name="third_party_wp_11za_origin_website" type="text" class="form-control" value="<?= CommonHelper::setting('third_party_wp_11za_origin_website') ?>" placeholder="Origin Website" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="card">
                <div class="card-header">
                    <h5>File Upload</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Document maximum upload size<span class="-req">*</span></label>
                                <input name="file_document_max_size" type="text" class="form-control numbers" value="<?= CommonHelper::setting('file_document_max_size') ?>" placeholder="Document maximum upload size" required>
                                <p><strong>Note:</strong>This upload size must be in MB.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Document Extensions<span class="-req">*</span></label>
                                <input name="file_document_extensions_allowed" type="text" class="form-control" value="<?= CommonHelper::setting('file_document_extensions_allowed') ?>" placeholder="Document Extensions" required>
                                <p><strong>Note:</strong>Extensions must be comma saprated.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Image maximum upload size<span class="-req">*</span></label>
                                <input name="file_image_max_size" type="text" class="form-control numbers" value="<?= CommonHelper::setting('file_image_max_size') ?>" placeholder="Image maximum upload size" required>
                                <p><strong>Note:</strong>This upload size must be in MB.</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Image Extensions<span class="-req">*</span></label>
                                <input name="file_image_extensions_allowed" type="text" class="form-control" value="<?= CommonHelper::setting('file_image_extensions_allowed') ?>" placeholder="Image Extensions" required>
                                <p><strong>Note:</strong>Extensions must be comma saprated.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   

            <div class="card">
                <div class="card-header">
                    <h5>Mail SMTP Details</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mail send from email<span class="-req">*</span></label>
                                <input name="smtp_mail_send_from" type="text" class="form-control" value="<?= CommonHelper::setting('smtp_mail_send_from') ?>" placeholder="Mail send from" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mail send from name<span class="-req">*</span></label>
                                <input name="smtp_mail_send_from_name" type="text" class="form-control" value="<?= CommonHelper::setting('smtp_mail_send_from_name') ?>" placeholder="Mail send from name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mail Host <span class="-req">*</span></label>
                                <input name="smtp_mail_host" type="text" class="form-control" value="<?= CommonHelper::setting('smtp_mail_host') ?>" placeholder="Mail Host" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mail User <span class="-req">*</span></label>
                                <input name="smtp_mail_user" type="text" class="form-control" value="<?= CommonHelper::setting('smtp_mail_user') ?>" placeholder="Mail User" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mail Password <span class="-req">*</span></label>
                                <input name="smtp_mail_password" type="text" class="form-control" value="<?= CommonHelper::setting('smtp_mail_password') ?>" placeholder="Mail Password" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Mail Port <span class="-req">*</span></label>
                                <input name="smtp_mail_port" type="text" class="form-control" value="<?= CommonHelper::setting('smtp_mail_port') ?>" placeholder="Mail Port" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-footer text-right">
                    <button class="btn btn-success">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>

    <style type="text/css">
        .card-header{
            border-bottom: 1px solid #ccc !important;
            margin-bottom: 15px;
        }
        .card-header h5{
            margin-bottom: 0;
        }
    </style>
@stop
