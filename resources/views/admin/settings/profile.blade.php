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
        <div class="row">
            <div class="col-md-12">
                <div class="cover-profile">
                    <div class="profile-bg-img">
                        <img class="profile-bg-img img-fluid" src="<?= url('themes/admin/assets/images/user-profile/bg-img1.jpg') ?>" alt="bg-img">
                        <div class="card-block user-info">
                            <div class="col-md-12">
                                <!-- <div class="media-left">
                                    <a href="javascript:;" class="profile-image">
                                        <img class="user-img img-radius" src="<?= url('public/admin/') ?>/images/user/male.png" alt="user-img">
                                    </a>
                                </div>
                                <div class="media-body row">
                                    <div class="col-lg-12">
                                        <div class="user-title">
                                            <h2><?= $item->name ?></h2>
                                            <span class="text-white">
                                                Admin 
                                            </span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form method="post" action="<?= CommonHelper::admin('profile/save') ?>" enctype="multipart/form-data">
         {{ csrf_field() }}


             <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name <span class="-req">*</span></label>
                                        <input name="name" type="text" class="form-control" value="<?= old("name",$item->name) ?>" placeholder="Name" required>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Username <span class="-req">*</span></label>
                                        <input name="username" type="text" class="form-control" value="<?= old("username",$item->username) ?>" placeholder="Username" required readonly>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="password" type="text" class="form-control" value="<?= old("password") ?>" placeholder="Password">
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email <span class="-req">*</span></label>
                                        <input name="email" type="email" class="form-control" value="<?= old("email",$item->email) ?>" placeholder="Email" required>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone <span class="-req">*</span></label>
                                        <input name="mobile" type="text" class="form-control" value="<?= old("mobile",$item->mobile) ?>" placeholder="Phone" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>

@stop