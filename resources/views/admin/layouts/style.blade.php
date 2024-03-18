<style type="text/css">
    .td-word-wrap th,.td-word-wrap td{
        white-space: normal !important;
    }
	
	.list-image-thumbnail-100{
		width: 100px;
		height: 100px;
		object-fit: cover;
	    object-position: center;
		border: solid 1px #ccc;
		border-radius: 10px;
	}

	.list-image-thumbnail{
		width: 70px;
		height: 70px;
		object-fit: cover;
	    object-position: center;
		border: solid 1px #ccc;
		border-radius: 10px;
	}

	.list-image-thumbnail-landscap{
		width: 100px;
		height: 70px;
		object-fit: cover;
	    object-position: center;
		border: solid 1px #ccc;
		border-radius: 10px;
	}

	.list-image-thumbnail-landscap-auto{
		width: 100%;
		object-fit: cover;
	    object-position: center;
		border: solid 1px #ccc;
		border-radius: 10px;
	}

	.m-t2{
   		margin-top: 2px;
   	}

    .tbl-whitespace td{
        white-space: normal !important;
    }

    .input-star-rating{
    	width: 100%;
        font-size: 15px;
        /*direction: rtl;*/
        text-align: center;
        display: inline-block;
    }
    .rating__icon {
	    pointer-events: none;
	}
	.rating__input {
   		position: absolute !important;
   		left: -9999px !important;
  	}

  	.rating__input--none {
    	display: none
  	}

  	.rating__label {
    	cursor: pointer;
    /* if you change the left/right padding, update the margin-right property of .rating__label--half as well. */
    	padding: 0 0.1em;
    	font-size: 33px;
    	text-shadow: 1px 1px #000000;
  	}

  	.rating__icon--star {
    	color: #FDD922;
  	}

  	.rating__input:checked ~ .rating__label .rating__icon--star {
    	color: #ccc;
  	}

  	.input-star-rating:hover .rating__label .rating__icon--star {
    	color: #FDD922;
  	}

  	.rating__input:hover ~ .rating__label .rating__icon--star {
    	color: #ccc;
  	}





	.toggle-switch{
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }
    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .toggle-switch .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }
    .toggle-switch .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    .toggle-switch input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
    .toggle-switch input:checked + .slider {
        background-color: #2196F3;
    }

    .toggle-switch input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    .toggle-switch .round{
        border-radius: 34px;
    }
    .toggle-switch .round:before{
        border-radius: 50%;
    }

	#read-more-popup-btn{
		font-size: 11px;
		color: #01a9ac;
	}
	.star-block-of-review i{
  		font-size:20px;
  		color:#ccc;
  		margin-left: 2px;
	}
	.star-block-of-review span i{
  		color:#FDD922;
	}
	.btn{
		margin-top: 5px;
	}

	.general-row-image{
		width: 60px;
		cursor: pointer;
	}
	.tb-row-image{
		width: 60px;
	}


	.kava-img-picker-lable{
		cursor: pointer;
		width: 80px;
		height: 80px;
	}
	.kava-img-picker-lable img{
		width: 80px;
		height: 80px;
		border-radius: 50%;
		border: solid 1px #ccc;
	}


	/*::-webkit-scrollbar {
	display: none;
	}*/
	/*th, td {
	    white-space: normal;
	}*/
	.table-dt th,.table-dt td{
		white-space: normal;
	}
	.notifyMy li{
		padding: 2px 5px;
		border-bottom: 1px solid #ccc;
	}
	.notifyMy{
		max-height: 350px;
	    overflow-y: scroll !important;
	}
	.header-navbar .navbar-wrapper .navbar-container .header-notification .show-notification .notification-msg{
		margin-bottom: 0;
	}
	.main-body .page-wrapper {
    	padding: 5px;
    }
    .main-body .page-wrapper .page-header {
	    margin-bottom: 12px;
	}
	.dis-block{
		display: block;
	}
	.val-error{
		color: red;
	}
	.btn-mini i{
		margin-right: 0px;
	}
	.-req{
		color: red;
		font-weight: bold;
	}
	.card-footer{
		background-color: #f6f6f6 !important;
	}
	.form-group label{
		font-weight: bold;
	}
	.select2-selection--single{
		    height: auto !important;
	}
	.select2-container--default .select2-selection--single .select2-selection__rendered {
		background: none;
	    color: #000;
	    padding: 0 10px 0;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow b{
		top: 20%;
		border-color:#888 transparent transparent transparent;
	}
	.m-t2{
		margin-top: 2px;
	}
	.datepicker table tr td.disabled,.datepicker table tr td.disabled:hover{
		color: #ccc;
	}
	.table-dt td, .table-dt th{
		padding: 5px;
	}

	.table-ndt td, .table-ndt th{
		padding: 5px;
	}
	.grid-images{
		width: auto;
	    height: 100px;
	    max-width: 100%;
	}

	.list-images{
		height: auto;
		max-height: 15px;
	}

	.list-image-span{
		margin: 0;
	    padding: 0;
	    margin-left: 5px;
	    margin-top: -4px;
	    width: 350px;
	}

	.table-no-padding td,.table-no-padding tH{
		padding: 5px;
	}

	.ajaxLoader{
		display: none;
		position: fixed;
	  	top: 0;
	  	bottom: 0%;
	  	left: 0;
	  	right: 0%;
	  	background-color: #cccccc87;
	  	z-index: 999999999999;
	}
	.ajaxLoader .loader{
		position: absolute;
		top: 50%;
	    left: 50%;
	    right: 50%;
	    bottom: 50%;
	}
	.small-table-kava td,.small-table-kava th{
		padding: 5px;
	}

	.kava-form-group{
		margin-bottom: 0;
	}
	.view-p-kava{
		margin-bottom: 0;
	    padding-top: calc(.5rem - 1px * 2);
	    padding-bottom: calc(.5rem - 1px * 2);
	}
	.kava-bottom-border{
		border-bottom: 1px solid #ccc;
	}
	.modal{
		z-index: 999999999 !important;
	}
	@media (min-width: 768px) {
	  	.modal-xl {
	    	width: 95%;
    		max-width: 1350px;
	  	}
	}
</style>
