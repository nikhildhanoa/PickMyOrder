"use strict";
// Class definition

var KTDatatableJsonRemoteDemo = function() {
    // Private functions

    // basic demo
    var business = function() {
		InvoiceUnderProject 
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetAllBusiness",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            }, 
			{
                field: 'business_name',
				 width: 180,
                title: 'Business Name',
            },
			{
                field: 'email',
                title: 'email',
				 width: 200,
                template: function(row) {
                    return row.email ;
                },
            }, {
                field: 'app_status',
                title: 'Status',
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                        0: {
                            'title': 'De-Activate',
                            'class': ' label-light-success'
                        },
                        1: {
                            'title': 'Activate',
                            'class': ' label-light-primary'
                        },
                        3: {
                            'title': 'Canceled',
                            'class': ' label-light-primary'
                        },
                        4: {
                            'title': 'Success',
                            'class': ' label-light-success'
                        },
                        5: {
                            'title': 'Info',
                            'class': ' label-light-info'
                        },            
                        6: {
                            'title': 'Danger',
                            'class': ' label-light-danger'                    
                        },
                        7: {
                            'title': 'Warning',
                            'class': ' label-light-warning'
                        },
                    };                      
                    return '<span class="label font-weight-bold label-lg' + status[row.app_status].class + ' label-inline">' + status[row.app_status].title + '</span>';
                },
            },
			//
			
			{
                field: 'iswholeapp',
                title: 'Type',
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
				
                    var status = {
                        0: {
                            'title': 'Contractor App',
                            'state': 'danger'
                        },
                        1: {
                            'title': 'Wholsaler App',
                            'state': 'primary'
                        },
                        2: {
                            'title': 'Invoice Management',
                            'state': 'success'
                        },
						3: {
                            'title': 'Brand Businees',
                            'state': 'warning'
                        },
                    };
                    return '<span class="label label-' + status[row.iswholeapp].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.iswholeapp].state + '">' +
                        status[row.iswholeapp].title + '</span>';
                },
            }, 
			
			{
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 120,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="editbusiness?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="delete?id='+row.id+'&type=business" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },
            }],

        });

        $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'app_status');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'iswholeapp');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 

// trial business

var TrialBusiness = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetTrialBusiness",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            }, 
			{
                field: 'business_name',
				 width: 180,
                title: 'Business Name',
            },
			{
                field: 'email',
                title: 'email',
				 width: 200,
                template: function(row) {
                    return row.email ;
                },
            }, {
                field: 'app_status',
                title: 'Status',
                // callback function support for column rendering
                template: function(row) {
                    var status = {
                        0: {
                            'title': 'De-Activate',
                            'class': ' label-light-success'
                        },
                        1: {
                            'title': 'Activate',
                            'class': ' label-light-primary'
                        },
                        3: {
                            'title': 'Canceled',
                            'class': ' label-light-primary'
                        },
                        4: {
                            'title': 'Success',
                            'class': ' label-light-success'
                        },
                        5: {
                            'title': 'Info',
                            'class': ' label-light-info'
                        },            
                        6: {
                            'title': 'Danger',
                            'class': ' label-light-danger'                    
                        },
                        7: {
                            'title': 'Warning',
                            'class': ' label-light-warning'
                        },
                    };                      
                    return '<span class="label font-weight-bold label-lg' + status[row.app_status].class + ' label-inline">' + status[row.app_status].title + '</span>';
                },
            },
			
			{
                field: 'expire_trial_time',
				 width: 180,
                title: 'Expire Date',
            },
			//
			
			{
                field: 'iswholeapp',
                title: 'Type',
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
				
                    var status = {
                        0: {
                            'title': 'Contractor App',
                            'state': 'danger'
                        },
                        1: {
                            'title': 'Wholsaler App',
                            'state': 'primary'
                        },
                        2: {
                            'title': 'Invoice Management',
                            'state': 'success'
                        },
                    };
                    return '<span class="label label-' + status[row.iswholeapp].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.iswholeapp].state + '">' +
                        status[row.iswholeapp].title + '</span>';
                },
            }, 
			
			{
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 120,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="editbusiness?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="delete?id='+row.id+'&type=business" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },
            }],

        });

        $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'app_status');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'iswholeapp');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 


/////
	
 //For User section 
    var users = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/getBusinessUsers",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            }, 
			{
                field: 'user_name',
				 width: 200,
                title: 'User Name',
            },
			{
                field: 'business',
				 width: 200,
                title: 'Business Name',
            },
			{
                field: 'last_login',
				 width: 200,
                title: 'Last Login',
            }
			, {
                field: 'email',
                title: 'Login as this User',
				 width: 200,
                 template: function(row) {
				
                  
                    return "<a href='https://app.pickmyorder.co.uk/adminlogin?id="+row.id+"'>Login</a>";
                },
            },
			{
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="editusers?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="delete?id='+row.id+'&type=users" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });

        $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'app_status');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'iswholeapp');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };      
	 //For supplier section 
    var supplier = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetAllNewSuppliers",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            }, 
			{
                field: 'suppliers_name',
				 width: 200,
                title: 'Supplier Name',
            },
			{
                field: 'contact_name',
				 width: 200,
                title: 'Contact Name',
            },
			 {
                field: 'email',
                title: 'Email',
				 width: 250,
                template: function(row) {
                    return row.email ;
                },
            },  
			{
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="editsuppliers?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="deletesuppliers?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });

        $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'app_status');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'iswholeapp');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };      
	
	//project section 
	
	 //For User section 
    var Projects = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetAllNewProjects",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: '',
                title: 'Project Number',
                sortable: false,
                width: 150,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            }, 
			{
                field: 'project_name',
				 width: 150,
                title: 'Project Name',
            },
			{
                field: 'customer_name',
				 width: 150,
                title: 'Customer',
            },
			 {
                field: 'email_address',
                title: 'Email',
				 width: 150,
                
			},
				{
                field: 'id',
                title: 'View Orders',
				 width: 150,
                template: function(row) {
                    return '<a href="OrderUnderProject?id='+row.id+'">View</a>' ;
                },
            },

             {
                field: 'business_id',
                title: 'View invoice',
				 width: 150,
                template: function(row) {
                    return '<a href="InvoiceUnderProject/'+row.id+'">View</a>' ;
                },
            },

			{
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="editprojects?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="deleteproject?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });

        $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'app_status');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'iswholeapp');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	 //For Engineer  
    var WholsalerEnginer = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetWholsalerEngineer",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
                field: 'name',
				 width: 200,
                title: 'Name',
            },
			{
                field: 'Operative',
				 width: 200,
                title: 'Type',
				template: function(row) {
				  var status = {
                        0: {
                            'title': 'Business',
                            
                        },
                        1: {
                            'title': 'Oprative',
                            
                        },
                        
                    };
					
					if(row.atradeya_retail)
					{
						 return "Guest" ;
					}
					else
					{
                     return status[row.Operative].title ;
					}
            }},
			
			{
                field: 'user_name',
				 width: 200,
                title: 'user_name',
            },
			
			
				{
                field: 'email',
                title: 'Email Address',
				 width: 250,
                template: function(row) {
                    return row.email ;
                },
            },  {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="EditWholesaler?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="deleteengineer?id='+row.id+'&uid='+row.user_id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });

        $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'app_status');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'iswholeapp');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
		 //For Engineer  
    var Engineer = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetAllEngineer",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'Project Number',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            }, 
			{
                field: 'name',
				 width: 200,
                title: 'Name',
            },
			{
                field: 'user_name',
				 width: 200,
                title: 'Username',
            },
			{
				field: 'Operative',
				 width: 200,
                title: 'Type',
				template: function(row) {
				  var status = {
                        0: {
                            'title': 'Supervisor',
                            
                        },
                        1: {
                            'title': 'Oprative',
                            
                        },
                        
                    };
                    return status[row.Operative].title ;
            }},
			 
			
				{
                field: 'email',
                title: 'Email Address',
				 width: 250,
                template: function(row) {
                    return row.email ;
                },
            },  {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="editengineer?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="deleteengineer?id='+row.id+'&&uid='+row.user_id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });



        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 

      
				 //For DeleveryCost page  
    var DeleveryCost = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetNewDeleveryCost",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
                field: 'title',
				 width: 200,
                title: 'title',
            },
			
			
			{
                field: 'cost',
				 width: 200,
                title: 'cost',
            },
			  {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="UpdateDeleveryCost?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="deleteshipping?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	// Stores
	
	   var Stores = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetOurStoreSection",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
                field: 'Store_Name',
				 width: 200,
                title: 'Store Name',
            },
			
			
			{
                field: 'Store_Address_one',
				 width: 200,
                title: 'Store Address',
            },
			 {
                field: 'defaultcheck',
				 width: 200,
                title: 'Default',
            },
			  {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="EditStore/'+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="deleteStoreSection?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	/*******************************Add New ProductsList******************************************************/

	
	   var ProductsList = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetAllNewProductList",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'List',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			 
			{
                field: 'productlistname',
				 width: 200,
                title: 'List',
            },
			
			 
			
				 {
                field: '',
                title: 'View',
				 width: 250,
                template: function(row) {
					
					if(row.id==43)
					{
						 return  "<a href='GetLukinsproductsInproductList'>View</a>";
					}
                     else
                     {
						  return  "<a href='ManageListProducts/null/"+row.id+"'>View</a>";
					 }						 
					
                   
				 }}, 
				 
					 {
                field: ' ',
                title: 'Master List',
				 width: 250,
                template: function(row) {
                    return  "<input type='checkbox' class='singlechecklist' value='"+row.id+"' style='background-color: #EBEDF3;border: 1px solid transparent;height: 18px;width: 18px;'>";
				 }}, 
              {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',    
                template: function(row) {
					var host = window.location.host; 
				   
				   if(row.id==43)
				   {
					  return '\
                       \
                        <a href="EditNewProductList?id='+row.id+'&name='+row.productlistname+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\ ';
                       
                     
				   }
				    else
					{
						return '\
                       \
                        <a href="EditNewProductList?id='+row.id+'&name='+row.productlistname+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="DeleteProductList?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
					}		
                    
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	/*************************************************Add Category list************************************************/
	
	
	   var CategoryList = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/FetchCategoryList",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'List',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			 
			{
                field: 'catalog_list_name',
				 width: 200,
                title: 'List',
            },
			
			
			
				 {
                field: '',
                title: 'View',
				 width: 250,
                template: function(row) {
                    return  "<a href='AddCategoryInListCategory?listid="+row.id+"'>View</a>";
				 }}, 
				 
					 {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',    
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="UpdateCategoryList?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="DeleteCategoryList?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	
	/*********************************************************************************************************/
	/*******************************Order section******************************************************/

	
	   var Order = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetNewThemeAllOrder",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
                field: 'po_reffrence',
				 width: 80,
                title: 'PO NUMBER',
            },
			{
                field: 'date',
				 width: 100,
                title: 'Date',         
            },
			
			
			
					{
						field: 'givenprojectname',
						 width: 100,
						title: 'Project',
					},
					{
						field: 'odrdescrp',
						 width: 150,
						title: 'Order Description',
					},
					/* {
						field: 'productlistname',
						 width: 100,
						title: 'Description',
					}, */
					{
						field: 'total_ex_vat',
						 width: 100,
						title: 'Total EX VAT',
						template: function(row)
						{
							return  "£"+row.total_ex_vat;
						}
					},
					{
						field: 'total_inc_vat',
						 width: 120,
						title: 'Total INC VAT',
						
						template: function(row)
						{
							return  "£"+row.total_inc_vat;
						}
					},
					
					{
                title: 'Order Type ',
                field: 'status',
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
				
                    var stattus = {
                        0: {
                            'title': 'Order',
                            'state': 'primary'
                        },
                        1: {
                            'title': 'Vanstock ',
                            'state': 'success1'
                        },
                        2: {
                            'title': 'Reorder ',
                            'state': 'danger'
                        },
                    };
                    return '<span class="label label-' + stattus[row.status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + stattus[row.status].state + '">' +
                        stattus[row.status].title + '</span>';
                },
            },
					 
					  {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 100,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="manageOrder?id='+row.id+'&orderno='+row.po_number+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                      ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	/************************************************************/
	
	   var ReorderProducts = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/listReorderProducts",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
                field: 'po_reffrence',
				 width: 80,
                title: 'PO NUMBER',
            },
			{
                field: 'date',
				 width: 100,
                title: 'Date',         
            },
			
			
			
					{
						field: 'givenprojectname',
						 width: 100,
						title: 'Project',
					},
					{
						field: 'odrdescrp',
						 width: 150,
						title: 'Order Description',
					},
					
					{
						field: 'total_ex_vat',
						 width: 100,
						title: 'Total EX VAT',
						template: function(row)
						{
							return  "£"+row.total_ex_vat;
						}
					},
					{
						field: 'total_inc_vat',
						 width: 120,
						title: 'Total INC VAT',
						
						template: function(row)
						{
							return  "£"+row.total_inc_vat;
						}
					},
					
					{
                title: 'Order Type ',
                field: 'status',
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
				
                    var stattus = {
                        0: {
                            'title': 'Order',
                            'state': 'primary'
                        },
                        1: {
                            'title': 'Vanstock ',
                            'state': 'success1'
                        },
                        2: {
                            'title': 'Reorder ',
                            'state': 'danger'
                        },
                    };
                    return '<span class="label label-' + stattus[row.status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + stattus[row.status].state + '">' +
                        stattus[row.status].title + '</span>';
                },
            },
					 
					 {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 100,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="ManageReorder?id='+row.id+'&orderno='+row.po_number+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                      ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	
	/************************************************************/
	/********************************************************************AWATING ORDERS****************************************************************
	***************************************************/

	
	   var AwatingOrders = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetNewThemeAllAwatingOrder",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
                field: 'po_reffrence',
				 width: 80,
                title: 'PO NUMBER',
            },
			{
                field: 'date',
				 width: 100,
                title: 'Date',         
            },
			
			
			
					{
						field: 'givenprojectname',
						 width: 100,
						title: 'Project',
					},
					{
						field: 'order_desc',
						 width: 150,
						title: 'OrderDescription',
					},
					
					{
						field: 'total_ex_vat',
						 width: 100,
						title: 'Total EX VAT',
						template: function(row)
						{
							return  "£"+row.total_ex_vat;
						}
					},
					{
						field: 'total_inc_vat',
						 width: 120,
						title: 'Total INC VAT',
						
						template: function(row)
						{
							return  "£"+row.total_inc_vat;
						}
					},
					
					  {
						field: 'status',
						 width: 60,
						title: 'Status',
						 template: function(row) {
                    var statusw = {
                        0: {
                            'title': 'Order',
                            'class': ' label-light-success'
                        },
                        1: {
                            'title': 'Panding',
                            'class': ' label-light-primary'
                        },
                       
                    };                      
                    return  statusw[row.status].title; 
                },
					}, 
             {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 100,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="manageOrder?id='+row.id+'&orderno='+row.po_number+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                      ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
		/*******************************Quotes******************************************************/

	
	   var Quotes = function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetAllDataQuotes",
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: '',
                title: '',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },	//	

			{
                field: 'date',
				 width: 100,
                title: 'Date',
            },
			{
                field: 'po_reffrence',
				 width: 100,
                title: 'Refrence No.',         
            },
			
			 {
                field: 'total_ex_vat',
				 width: 200,
                title: 'Total EX.VAT',
            }
			, 
			
					{
						field: 'total_inc_vat',
						 width: 200,
						title: 'Total INC.VAT',
					},
					  
					
				 {
                field: '',
                title: '',
				 width: 250,
                template: function(row) {
                    return  "<span>View</span>";
				 }}, 
					
             {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="manageOrder?id='+row.id+'&orderno='+row.po_number+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="DeleteQuote?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	/***************************************************Order Under Project*****************************************/
	var orderUnderProject =	 function(id) {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetNewThemeOrderUnderProject?id="+id,
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
                field: 'po_reffrence',
				 width: 80,
                title: 'PO NUMBER',
            },
			{
                field: 'date',
				 width: 100,
                title: 'Date',         
            },
			
			 
			
					{
						field: 'givenprojectname',
						 width: 150,
						title: 'Project Name',
					},
					
					
					{
						field: 'invioce_Order_Number',
						 width: 150,
						title: 'Order No.',
					},
					{
						field: 'total_ex_vat',
						 width: 100,
						title: 'Total EX VAT',
						template: function(row)
						{
							return  "£"+row.total_ex_vat;
						}
					},
					{
						field: 'total_inc_vat',
						 width: 120,
						title: 'Total INC VAT',
						
						template: function(row)
						{
							return  "£"+row.total_inc_vat;
						}
					},
					
					{
						field: 'status',
						 width: 60,
						title: 'Status',
						 template: function(row) {
                    var statusw = {
                        0: {
                            'title': 'Order',
                            'class': ' label-light-success'
                        },
                        1: {
                            'title': 'Panding',
                            'class': ' label-light-primary'
                        },
                       
                    };                      
                    return  statusw[row.status].title; 
                },
					},
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 100,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="manageOrder?id='+row.id+'&orderno='+row.po_number+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                      ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	/***************************************************************************************************************/
		/***************************************************Products*****************************************/
	var product =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/GetNewThemeProducts",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [
				{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: 'kt_datatable_checkbox_value'
					},
					textAlign: 'center',
				},
				{
					field: 'po_reffrence',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.products_images+ ' width="50px" heigth="50px">'; 
					},
				},
				{
					field: 'title',
					 width: 150,
					title: 'Product Title',         
				},
				{
					field: 'SKU',
					 width: 100,
					title: 'Sku',         
				},
					{
						field: 'publish_status',
						 width: 80,
						title: 'Status',
						  template: function(row) {
                    var status = {
                        1: {
                            'title': 'Publish',
                            'class': ' label-light-success'
                        },
                        0: {
                            'title': 'Un-Publish',
                            'class': ' label-light-primary'
                        },
                       
                    };                      
                    return '<span class="label font-weight-bold label-lg' + status[row.publish_status].class + ' label-inline">' + status[row.publish_status].title + '</span>';
                },
						
					},
              {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="Edit_single_product?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="DeleteProducts?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Category');
        });
		/*****************open****************/
         $('#kt_datatable_delete_all').on('click', function() {
			  
			 
			 var selected = [];
				$('.kt_datatable_checkbox_value input:checked').each(function() {
					selected.push($(this).val());
				});
			
			
			 
			if(selected.length === 0)
			{
				alert("Please select products to Delete");
				
			}
			else if(confirm("confirm To Delete products?"))
			{	
				
			
			$.ajax({
			  url: "DeleteMultipleProducts",
			 type: "POST",
			 data:{'selected':selected},
			
			 success: function(data) {
                 
				 if(data==1)
				 {
                            		
				alert("Products Deleted");	
				  location.reload();
                 }
			 }
		}); 
			}		
			 
		});
	    
                 /**************************/	

	/**********open***********/	 
       $('#kt_datatable_pulish_all').on('click', function() {
			  
			 
			 var selected = [];
				$('.kt_datatable_checkbox_value input:checked').each(function() {
					selected.push($(this).val());
				});
			
                if(selected.length === 0)
			{
				alert("Please select products to publish");
				
			}
			else if(confirm("confirm To publish products?"))
			{	
				
			
			$.ajax({
			  url: "publishedMultipleProducts",
			 type: "POST",
			 data:{'selected':selected},
			
			 success: function(data) {
                 
				 if(data==1)
				 {
                            		
				alert("Products Published");	
				  location.reload();
                 }
			 }
		}); 
			}
			
	   });	
	   
		/**********open***********/	 
       $('#kt_datatable_UnPublish_all').on('click', function() {
			  
			 
			 var selected = [];
				$('.kt_datatable_checkbox_value input:checked').each(function() {
					selected.push($(this).val());
				});
			
                if(selected.length === 0)
			{
				alert("Please select products to Unpublish");
				
			}
			else if(confirm("confirm To Unpublish products?"))
			{	
				
			
			$.ajax({
			  url: "unpublishedMultipleProducts",
			 type: "POST",
			 data:{'selected':selected},
			
			 success: function(data) {
                 
				 if(data==1)
				 {
                            		
				alert("Products UnPublished");	
				  location.reload();
                 }
			 }
		}); 
			}
			
	   });		
/**********************************************/
$('#Import_To_List').on('click', function() {
  
               var selected = [];
				$('.kt_datatable_checkbox_value input:checked').each(function() {
					selected.push($(this).val());
				});
				
		var listid= $('#kt_datatable_Category_List').val();	
                
		     if(selected.length === 0)
			{
				alert("Please select products ");
				
			}
            if(listid == 0)
			{
				alert("Please select products List ");
				
			}
            else
            {
				
				$.ajax({
			  url: "copypmoproductsinproductsList",
			 type: "POST",
			 data:{'selected':selected,'listid':listid},
			
			 success: function(data) {
                 
				 if(data==1)
				 {
                            		
				alert("Products Copy");
                $('#kt_datatable_Category_List').val(0);				
				  location.reload();
                 }
			 }
		});
			}				
  
});     				 
        
		
		
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
		
/************************************************/

var LukinsFailureProducts =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/GetLukinsFailureProducts",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [
				 {
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: 'kt_datatable_checkbox_value'
					},
					textAlign: 'center',
				}, 
				{
					field: 'po_reffrence',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.products_images+ ' width="50px" heigth="50px">'; 
					},
				},
				{
					field: 'title',
					 width: 150,
					title: 'Product Title',         
				},
				{
					field: 'SKU',
					 width: 100,
					title: 'Sku',         
				},
					{
						field: 'publish_status',
						 width: 80,
						title: 'Status',
						  template: function(row) {
                    var status = {
                        1: {
                            'title': 'Publish',
                            'class': ' label-light-success'
                        },
                        0: {
                            'title': 'Un-Publish',
                            'class': ' label-light-primary'
                        },
                       
                    };                      
                    return '<span class="label font-weight-bold label-lg' + status[row.publish_status].class + ' label-inline">' + status[row.publish_status].title + '</span>';
                },
						
					},
             {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="Edit_single_product?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="DeleteProducts?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Category');
        });
		/*****************open****************/
         
                  $('#kt_datatable_delete_all').on('click', function() {
			  
			 
			 var selected = [];
				$('.kt_datatable_checkbox_value input:checked').each(function() {
					selected.push($(this).val());
				});
			
			
			 
			if(selected.length === 0)
			{
				alert("Please select products to Delete");
				
			}
			else if(confirm("confirm To Delete products?"))
			{	
				
			
			$.ajax({
			  url: "DeleteMultipleProducts",
			 type: "POST",
			 data:{'selected':selected},
			
			 success: function(data) {
                 
				 if(data==1)
				 {
                            		
				alert("Products Deleted");	
				  location.reload();
                 }
			 }
		}); 
			}		
			 
		});
	    
                 /**************************/	

	/**********open***********/	 
       $('#kt_datatable_pulish_all').on('click', function() {
			  
			 
			 var selected = [];
				$('.kt_datatable_checkbox_value input:checked').each(function() {
					selected.push($(this).val());
				});
			
                if(selected.length === 0)
			{
				alert("Please select products to publish");
				
			}
			else if(confirm("confirm To publish products?"))
			{	
				
			
			$.ajax({
			  url: "publishedMultipleProducts",
			 type: "POST",
			 data:{'selected':selected},
			
			 success: function(data) {
                 
				 if(data==1)
				 {
                            		
				alert("Products Published");	
				  location.reload();
                 }
			 }
		}); 
			}
			
	   });	
	   
		/**********open***********/	 
       $('#kt_datatable_UnPublish_all').on('click', function() {
			  
			 
			 var selected = [];
				$('.kt_datatable_checkbox_value input:checked').each(function() {
					selected.push($(this).val());
				});
			
                if(selected.length === 0)
			{
				alert("Please select products to Unpublish");
				
			}
			else if(confirm("confirm To Unpublish products?"))
			{	
				
			
			$.ajax({
			  url: "unpublishedMultipleProducts",
			 type: "POST",
			 data:{'selected':selected},
			
			 success: function(data) {
                 
				 if(data==1)
				 {
                            		
				alert("Products UnPublished");	
				  location.reload();
                 }
			 }
		}); 
			}
			
	   });		

      
	   
		/**********open***********/	 
      		

         				 
        
		
		
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
		



/************************************************/		
		
		
		
		/******************************van stock**********************************************/
		var vanstock =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/Getvanstock",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'product_id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				{
					field: 'po_reffrence',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.products_images+ ' width="50px" heigth="50px">'; 
					},
				},
				{
					field: 'title',
					 width: 150,
					title: 'Product Title',         
				},
				{
					field: 'SKU',
					 width: 100,
					title: 'Sku',         
				},
				{
					field: 'instock',
					 width: 100,
					title: 'Stock QTY',         
				},
				 {
					field: 'toback_instock',
					 width: 100,
					title: 'On Order',         
				},
				{
					field: 'onorder',
					 width: 100,
					title: 'SubTotal', 
                   template: function(row) {
                                    
                    return '£' + row.onorder + '';
                }					
				}, 
				
					{
						field: 'publish_status',
						 width: 80,
						title: 'Status',
						  template: function(row) {
                    var status = {
                        1: {
                            'title': 'Publish',
                            'class': ' label-light-success'
                        },
                        0: {
                            'title': 'Un-Publish',
                            'class': ' label-light-primary'
                        },
                       
                    };                      
                    return '<span class="label font-weight-bold label-lg' + status[row.publish_status].class + ' label-inline">' + status[row.publish_status].title + '</span>';
                },
						
					},
             {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="Edit_single_product?id='+row.product_id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="DeleteProducts?id='+row.product_id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'searchcat');
        });
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	/***********************************vans*************************************/
	var Vans  =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/GetAllVans",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'driver_name',
					 width: 150,
					title: 'Driver Name ',         
				},
				{
					field: 'vehicle_registration',
					 width: 100,
					title: 'Vehicle Registration',         
				},
				{
					field: 'make',
					 width: 100,
					title: 'Make ',         
				},
				{
					field: 'model',
					 width: 100,
					title: 'Model ',           
				},
				{
					field: 'type',
					 width: 100,
					title: 'Type ',         
				},
				{
					field: 'user_name',
					 width: 150,
					title: 'Engineer ',         
				},
					 {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
					    <a  href="vanAllProducts?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <i class="fa fa-eye" aria-hidden="true"></i>\
                            </span>\
                        </a>\
                        <a href="Editvans?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a onClick="javascript: return confirm('+"'Please confirm deletion'"+');" href="Deletevans?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'searchcat');
        });
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();   
    };
	/******************************vanallproducts******************************************/
	
	var ManageListProducts  =	 function(stuff,text2) {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/GetAllListProducts?id="+stuff+'&&ids='+text2,
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: 'kt_datatable_checkbox_value'
					},
					textAlign: 'center',
				},
				
				
				{
					field: 'Image',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.products_images+ ' width="50px" heigth="50px">'; 
					},
				},
				
				{
					field: 'title',
					 width: 100,
					title: 'product Title ',         
				},
				
				{
					field: 'SKU',
					 width: 100,
					title: 'Sku',         
				},
					{
						field: 'publish_status',
						 width: 80,
						title: 'Status',
						  template: function(row) {
                    var status = {
                        1: {
                            'title': 'Publish',
                            'class': ' label-light-success'
                        },
                        0: {
                            'title': 'Un-Publish',
                            'class': ' label-light-primary'
                        },
                       
                    };                      
                    return '<span class="label font-weight-bold label-lg' + status[row.publish_status].class + ' label-inline">' + status[row.publish_status].title + '</span>';
                },
						
					},
				
				
				
					  {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
						return '\
                       \
                        <a href="Edit_single_product?id='+row.id+'&list='+stuff+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="RemoveListFromAProduct?product='+row.id+'&list='+stuff+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    '; 
						 
						 
						 
						 
						 
						 
										 
					 
					
                },            
            }],

        });
		
	/// cate gory start
		  $('#kt_datatable_search_type').on('change', function() {
			
          var catid = $('#kt_datatable_search_type option:selected').val(); 
		  var url = window.location.href; 
		
		 if(catid!='0'){
			 
			    $('#kt_datatable_search_type_Sub_Category').removeAttr("disabled")
			 
			  $("#kt_datatable_search_type_Sub_Category").html("");
			  $.ajax({
					  url: "FilterProductListProduct",
					 type: "POST",
					 data:{'catid':catid,'url':url},
					
					 success: function(data) {
						 
								var SubCat="";
								SubCat += '<option value="0">All</option>';
							   var SubCategory = JSON.parse(data);
							   
							   for (var z = 0; z < SubCategory.length; z++)
							   { 
						  
								   SubCat +='<option value="'+SubCategory[z].id+'">'+SubCategory[z].sub_cat_name+'</option>';
							   }
							 
								  $("#kt_datatable_search_type_Sub_Category").html(SubCat);
						  
					 }
				});
		  }else
          {
			   $("#kt_datatable_search_type_Sub_Category").html('');
			   $("#kt_datatable_search_type_Sub_Category").html(' <option value="0">All</option>'); 
			   
		    	$("#kt_datatable_search_type_Sub_Sub_Category").html(''); 
			    $("#kt_datatable_search_type_Sub_Sub_Category").html(' <option value="0">All</option>');
			 
		  }			  
        });
		
		// start sub cat 
		
		$('#kt_datatable_search_type_Sub_Category').on('change', function() {
			
          var subcatid = $('#kt_datatable_search_type_Sub_Category option:selected').val(); 
		  var url = window.location.href; 
		
		   if(subcatid!='0' ){
			    $("#kt_datatable_search_type_Sub_Sub_Category").html("");
				$('#kt_datatable_search_type_Sub_Sub_Category').removeAttr("disabled")
			  $.ajax({
					  url: "FilterProductListProduct2",
					 type: "POST",
					 data:{'subcatid':subcatid,'url':url},
					
					 success: function(data) {
						 
								var SubCat="";
								SubCat += '<option value="0">All</option>';
							   var SubCategory = JSON.parse(data);
							   
							   for (var z = 0; z < SubCategory.length; z++)
							   { 
						  
								   SubCat +='<option value="'+SubCategory[z].id+'">'+SubCategory[z].name+'</option>';
							   }
							 
								  $("#kt_datatable_search_type_Sub_Sub_Category").html(SubCat);
						  
					 }
				}); 
		   }else
		   {
			      $("#kt_datatable_search_type_Sub_Sub_Category").html('');
			    $("#kt_datatable_search_type_Sub_Sub_Category").html('<option value="0">All</option>');
		   }
        });
		
		
		/// end subcat
        
		/// man start
		$('.common-class').on('change', function() {
			
			     var Value  = $(this).val();
			     var idName = $(this).attr("id");
			  
			     var url = window.location.href; 
			     var myarr = url.split("/");
			     var index=myarr.length;
			     var listno = myarr[index-1];
		
		    
		      $.ajax({
					  url: "FilterProductListProduct3",
					 type: "POST",
					 data:{'Value':Value,'idName':idName,'listno':listno},
					
					 success: function(data) {
						 
								 var man="";
								man += '<option value="">All</option>';
							   var mandata = JSON.parse(data);
							   
							   for (var z = 0; z < mandata.length; z++)
							   { 
						  
								   man +='<option value="'+mandata[z].Manufacture+'">'+mandata[z].Manufacture+'</option>';
							   }
							 
								  $("#kt_datatable_search_status").html(man); 
						  
					 }
				});
			
			  
			
		});
		
		
		// man end
		
		
		 /// submit start 
		 	$('#submit').on('click', function() {
				
				
			  var catid = $('#kt_datatable_search_type option:selected').val(); 
                 catid  = (catid!=0) ? catid : '0';		  
			 var subcatid = $('#kt_datatable_search_type_Sub_Category option:selected').val(); 	
			 subcatid  = (subcatid!=0) ? subcatid : '0';
			var Subsubcatid = $('#kt_datatable_search_type_Sub_Sub_Category option:selected').val(); 
			Subsubcatid  = (Subsubcatid!=0) ? Subsubcatid : '0';
		    var man = $('#kt_datatable_search_status option:selected').html(); 
			man  = (man!='All') ? man : '0';
			
				  var url = window.location.href; 
			     var myarr = url.split("/");
			     var index=myarr.length;
			     var listno = myarr[index-1];
					
	          
				 
				
		window.location.replace("https://app.pickmyorder.co.uk/ManageListProducts/"+catid+"-"+subcatid+"-"+Subsubcatid+"-"+man+"/"+listno+"");
				
			});
		 /// end submit 
		 
     
		
		$('#Import_To_List').on('click', function() {
  
               var selected = [];
				$('.kt_datatable_checkbox_value  input:checked').each(function() {
					selected.push($(this).val());
				});
				
		var listid= $('#kt_datatable_Category_List').val();	
                
		     if(selected.length === 0)
			{
				alert("Please select products ");
				
			}
            if(listid == 0)
			{
				alert("Please select products List ");
				
			}
            else
            {
				
				$.ajax({
			  url: "copypmoproductsinproductsList",
			 type: "POST",
			 data:{'selected':selected,'listid':listid},
			
			 success: function(data) {
                 
				 if(data==1)
				 {
                            		
				alert("Products Copy");
                $('#kt_datatable_Category_List').val(0);				
				  location.reload();
                 }
			 }
		});
			}				
  
});
		
		
		
		
		
    };
	
	
	
	/**************************************************************************************/
	var vanAllProducts  =	 function(vanId) {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchvanAllProducts?id="+vanId,
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'po_reffrence',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.products_images+ ' width="50px" heigth="50px">'; 
					},
				},
				
				{
					field: 'title',
					 width: 100,
					title: 'product Title ',         
				},
				{
					field: 'SKU',
					 width: 100,
					title: 'SKU',         
				},
				{
					field: 'stocklevel',
					 width: 100,
					title: 'stocklevel ',         
				},
				{
					field: 'recordlevel',
					 width: 100, 
					title: 'Reorderlevel ',          
				},
				{
					field: 'in_stock',   
					 width: 100,
					title: 'In Stock ',         
				},
				{
					field: 'onorder',   
					 width: 100,
					title: 'SubTotal ', 
					template: function(row) {
                                    
                    return '£' + row.onorder + '';
                }
					
				},
				{
					field: 'toback_instock',   
					 width: 100,
					title: 'On Order ', 
					
					
				},
				
					  {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="UpdateAllProduct?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a onClick="javascript: return confirm('+"'Please confirm deletion'"+');" href="DeleteVanAllProducts?id='+row.id+'&vanid='+vanId+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'searchcat');
        });
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	/*******************************vanengineer******************************************/
	var VanEngineers  =	 function(vanId) {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchVanEngineers?id="+vanId,
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				
				
				{
					field: 'name',
					 width: 150,
					title: 'Name ',         
				},
				
				{
					field: 'user_name',
					 width: 100,
					title: 'User Name ',         
				},
				{
					field: 'email',
					 width: 100,
					title: 'Email ',         
				},
				
				
					 {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="DeleteVanEngineers?id='+row.id+'&vanid='+vanId+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'searchcat');
        });
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	/************************************getvanorder*************************************/
	var VanAllOrder = function(vanId) {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetVanAllOrder?id="+vanId,
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
                field: 'po_reffrence',
				 width: 80,
                title: 'PO NUMBER',
            },
			{
                field: 'date',
				 width: 100,
                title: 'Date',         
            },
			
			 
			
					{
						field: 'givenprojectname',
						 width: 100,
						title: 'Project',
					},
					{
						field: 'odrdescrp',
						 width: 150,
						title: 'Order Description',
					},
					
					{
						field: 'total_ex_vat',
						 width: 100,
						title: 'Total EX VAT',
						template: function(row)
						{
							return  "£"+row.total_ex_vat;
						}
					},
					{
						field: 'total_inc_vat',
						 width: 120,
						title: 'Total INC VAT',
						
						template: function(row)
						{
							return  "£"+row.total_inc_vat;
						}
					},
					
					{
                title: 'Order Type ',
                field: 'status',
                autoHide: false,
                // callback function support for column rendering
                template: function(row) {
				
                    var stattus = {
                        0: {
                            'title': 'Order',
                            'state': 'primary'
                        },
                        1: {
                            'title': 'Vanstock ',
                            'state': 'success1'
                        },
                        2: {
                            'title': 'Reorder ',
                            'state': 'danger'
                        },
                    };
                    return '<span class="label label-' + stattus[row.status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + stattus[row.status].state + '">' +
                        stattus[row.status].title + '</span>';
                },
            },
					 
					 {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 100,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="manageOrder?id='+row.id+'&orderno='+row.po_number+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                      ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    }; 
	/****************************listcategory category********************************/
	 
	
	var AddCategoryInListCategory = function(ListId) {
		
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source:"https://app.pickmyorder.co.uk/GetCategoryForCategorylist?listid="+ListId,
                pageSize: 10,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,            

            pagination: true,

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [{
                field: 'id',
                title: 'id',
                sortable: false,
                width: 20,
                type: 'number',
                selector: {
                    class: ''
                },
                textAlign: 'center',
            },
			{
					field: 'image',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.image+ ' width="50px" heigth="50px">'; 
					},
				},
				
			{
                field: 'cat_name',
				 width: 100,
                title: 'cats',         
            },
			
			  {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 100,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host;     
				   
                    return '\
                       \
                         <a href="DeleteCategoryForCategorylist?id='+row.id+'&listid='+ListId+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                      ';
                },            
            }],

        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	
	/************************************************************/
	/************************************************************************/
	/********************************nOTIFICATION***********************************/
	var Notifictions =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/GetAllNtofications",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				{
					field: 'business_name',
					 width: 150,
					title: 'Businees Name',        
				},
				{
					field: 'message',
					 width: 150,
					title: 'Message',         
				},
				{
					field: 'datetime',
					 width: 150,
					title: 'Date/Time',         
				},
             {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                      \
                        <a href="DeleteNotification?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'searchcat');
        });
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();  
    };
	/********************************************************/
	
	/*********************Product page*********************/
	var category =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/GetCatOnNewTheme",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				 
				{
					field: 'image',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.image+ ' width="50px" heigth="50px">'; 
					},
				},
				{
					field: 'cat_name',
					 width: 150,
					title: 'Category Name',         
				},
				
					
           {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
				  /*  let pages = pageText ? parseInt(pageText) : undefined; */
				   
				   
                    return '\
                       \
                        <a href="EditNewThemeCategory?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
						 <a  href="SubCategory?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="view">\
                            <span class="svg-icon svg-icon-md">\
                                <i class="fa fa-eye" aria-hidden="true"></i>\
                            </span>\
                        </a>\
                        <a href="DeleteCat?cat_id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'searchcat');
        });
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	/********************************************************************/
	var SubCategory =	 function(catid) { 
		
        var datatable = $('#kt_datatable').KTDatatable({    
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/GetAllSubCategory?id="+catid,
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				 
				{
					field: 'image',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.image+ ' width="50px" heigth="50px">'; 
					},
				},
				{
					field: 'sub_cat_name',
					 width: 150,
					title: 'Sub Category Name',         
				},
				
					
           {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="EditSubCategory?id='+row.id+'&catid='+catid+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
						 <a  href="superSubCategory/'+row.id+'" class="btn btn-sm btn-clean btn-icon" title="view">\
                            <span class="svg-icon svg-icon-md">\
                                <i class="fa fa-eye" aria-hidden="true"></i>\
                            </span>\
                        </a>\
                        <a href="DeleteSubCategory?id='+row.id+'&catid='+catid+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		
	 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'searchcat');
        });
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	/*********************************************************** */
	var superSubCategory =	 function(stuff) { 
		
        var datatable = $('#kt_datatable').KTDatatable({    
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/GetAllSuperSubCategory?id="+stuff,
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 30,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				 
				{
					field: 'image',
					 width: 100,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.image+ ' width="50px" heigth="50px">'; 
					},
				},
				{
					field: 'name',
					 width: 200,
					title: 'Sub Sub Category Name',         
				},
				
					
           {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 140,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="EditSuperSubCategory/'+row.id+'/'+stuff+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="DeleteSuperSubCategory?id='+row.id+'&catid='+stuff+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		
	 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Manufacture');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'searchcat');
        });
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
  
	/*********************advertisment*****************************/
	
	
	var Advertisment =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/Fetchads",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [
				 {
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: 'kt_datatable_checkbox_value'
					},
					textAlign: 'center',
				}, 
				
				
				
				{
					field: 'source',
					 width: 80,
					title: 'Image',
						 template: function(row) {                   
						return  '<img src=' +row.source+ ' width="50px" heigth="50px">'; 
					},
				}, 
				
				{
                field: 'status_name',
				 width: 150,
                title: 'Tab Name',
                 },
					
					{
						field: 'publish_status',
						 width: 80,
						title: 'Status',
						  template: function(row) {
                    var status = {
                        1: {
                            'title': 'Publish',
                            'class': 'label-light-Green'
                        },
                        0: {
                            'title': 'Un-Publish',
                            'class': ' label-light-danger'
                        },
						
                       
                    };                      
                    return '<span class="label font-weight-bold label-lg' + status[row.publish_status].class + ' label-inline">' + status[row.publish_status].title + '</span>';
                },
						
					},
					
					
					
             {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="Editads?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="Deleteads?id='+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		 $('#kt_datatable_search_status').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'status_name');
		
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'brands_id');
        });
		/*****************open****************/
         
	    
            
      		
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
		
	/************************invoice*****************************/
	var Invoice =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchInvoices",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'vendor_name',
					 width: 150,
					title: 'Supplier Name',         
				},
				{
					field: 'order_number2',
					 width: 140,
					title: 'Order N0.',         
				},
			
				{
					field: 'document_number',
					 width: 90,
					title: 'Invoice N0.',
                    template: function(row) {

                    if(row.flag_invoice==1) 
                     {
						 return '<a href="pdfview/'+row.id+'/'+row.order_number+'" style="color:red;">'+row.document_number+'</a>' ;
                     }else if
                     (row.Allocate_project!=0)
                      {
                       return '<a href="pdfview/'+row.id+'/'+row.order_number+'" style="color:green;">'+row.document_number+'</a>' ;
                       }
                      else
                      {
						return '<a href="pdfview/'+row.id+'/'+row.order_number+'">'+row.document_number+'</a>' ;
                      }


                   
                },	
				},
				{
					field: 'invoice_date',
					 width: 100,
					title: 'Invoice Date',         
				},
				
				
				{
					field: 'subtotal',
					 width: 90,
					title: 'subtotal',         
				},
				{
					field: 'tax',
					 width: 90,
					title: 'tax',         
				},
				{
					field: 'total',
					 width: 90,
					title: 'total',         
				},
					
           ],

        });
		
        
        $('#kt_datatable_search_month').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'current_month');
		
        });
		
		 $('#kt_datatable_search_status').selectpicker();
    };
	/*************************************************/
  
	var InvoiceUnderProject =	 function(InvoiceId) {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchInvoiceUnderProject/"+InvoiceId,
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'vendor_name',
					 width: 150,
					title: 'Supplier Name',         
				},
				{
					field: 'order_number2',
					 width: 140,
					title: 'Order N0.',         
				},
			
				{
					field: 'document_number',
					 width: 90,
					title: 'Invoice N0.',
                    template: function(row) {

                    if(row.flag_invoice==1) 
                     {
						 return '<a href="pdfview/'+row.id+'/'+row.order_number+'" style="color:red;">'+row.document_number+'</a>' ;
                     }else if
                     (row.Allocate_project!=0)
                      {
                       return '<a href="pdfview/'+row.id+'/'+row.order_number+'" style="color:green;">'+row.document_number+'</a>' ;
                       }
                      else
                      {
						return '<a href="pdfview/'+row.id+'/'+row.order_number+'">'+row.document_number+'</a>' ;
                      }


                   
                },	
				},
				{
					field: 'invoice_date',
					 width: 100,
					title: 'Invoice Date',         
				},
				
				
				{
					field: 'subtotal',
					 width: 90,
					title: 'subtotal',         
				},
				{
					field: 'tax',
					 width: 90,
					title: 'tax',         
				},
				{
					field: 'total',
					 width: 90,
					title: 'total',         
				},
					
           ],

        });
		
        
        $('#kt_datatable_search_month').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'current_month');
		
        });
		
		 $('#kt_datatable_search_status').selectpicker();
    };
   /**************************************************/

	/***************** Quotation*********************/
	var Quotation =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchQuotation",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				{
					field: 'vendor_name',
					 width: 150,
					title: 'Supplier Name',         
				},
				{
					field: 'order_number2',
					 width: 140,
					title: 'Order N0.',         
				},
				{
					field: 'invoice_date',
					 width: 140,
					title: 'Quotes Date',         
				},
				{
					field: 'document_number',
					 width: 150,
					title: 'Quotes N0.',
                    template: function(row) {
                    return '<a href="pdfview/'+row.id+'/'+row.order_number+'">'+row.document_number+'</a>' ;
                },	
				},
				{
					field: 'subtotal',
					 width: 100,
					title: 'subtotal',         
				},
				{
					field: 'tax',
					 width: 100,
					title: 'tax',         
				},
				{
					field: 'total',
					 width: 100,
					title: 'total',         
				},
				 /* {
                field: 'Attachment',
                title: 'View Quotes',
				 width: 100,
                template: function(row) {
                    return '<a href="'+row.Attachment+'"  target="_blank"> view</a>' ;
                },
            },  */
			
				
					
           ],

        });
		
         $('#kt_datatable_search_month').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'current_month');
		
        });
		
		 $('#kt_datatable_search_status').selectpicker();
      
    };
	
	/***************************************/
	/************************ productCatalogue *****************************/
	var productCatalogue =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/productCatalogueDataFetch",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				
				{
					field: 'part_number',
					 width: 90,
					title: 'Part No.',         
				},
			
				{
					field: 'description',
					 width: 200,
					title: 'Description.',
                    	
				},
				{
					field: 'qty',
					 width: 80,
					title: 'Quantity',         
				},
				{
					field: 'price',
					 width: 90,
					title: 'Price',         
				},
				
				
				{
					field: 'per_uom',
					 width: 80,
					title: 'Per',         
				},
				{
					field: 'discount',
					 width: 80,
					title: 'Discount',         
				},
				{
					field: 'total',
					width: 90,
					title: 'total',         
				},
				 /* {
                field: 'Attachment',
                title: 'View Invoice ',
				 width: 100,
                template: function(row) {
                    return '<a href="'+row.Attachment+'"  target="_blank"> view</a>' ;
                },
            },  */ 
			
				
					
           ],

        });
		
        
        $('#kt_datatable_search_month').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'current_month');
		
        });
		
		 $('#kt_datatable_search_status').selectpicker();
    };
	
	/***************** invoiceIndividualDetails*********************/
	var invoiceIndividualDetails =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/invoiceNylasAttachmentDetails",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'qty',
					 width: 150,
					title: 'QTY',         
				},
				
				{
					field: 'part_number',
					 width: 140,
					title: 'Part No.',         
				},
				
				{
					field: 'description',
					 width: 140,
					title: 'Description',         
				},
				
				{
					field: 'price',
					 width: 150,
					title: 'Price.',
                   // template: function(row) {
                    //return '<a href="pdfview/'+row.id+'/'+row.order_number+'">'+row.document_number+'</a>' ;
                //},	
				},
				
		
				{
					field: 'per_uom',
					 width: 100,
					title: 'Per Uom',         
				},
				{
					field: 'discount',
					 width: 100,
					title: 'Discount',         
				},
				{
					field: 'total',
					 width: 100,
					title: 'Total',         
				},
				 /* {
                field: 'Attachment',
                title: 'View Quotes',
				 width: 100,
                template: function(row) {
                    return '<a href="'+row.Attachment+'"  target="_blank"> view</a>' ;
                },
            },  */
			
				
					
           ],

        });
		
         $('#kt_datatable_search_month').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'current_month');
		
        });
		
		 $('#kt_datatable_search_status').selectpicker();
      
    };
	
	/***************************************/
	
	
	
	var Creditnote =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchCreditnote",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'vendor_name',
					 width: 150,
					title: 'Supplier Name',         
				},
				
				{
					field: 'invoice_date',
					 width: 140,
					title: 'Credit Date',         
				},
				
				{
					field: 'order_number2',
					 width: 140,
					title: 'Order N0.',         
				},
				
				{
					field: 'document_number',
					 width: 140,
					title: 'Credit No.',
                    template: function(row) {
                    return '<a href="pdfview/'+row.id+'/'+row.order_number+'">'+row.document_number+'</a>' ;
                },	
				},
				
				
				{
					field: 'subtotal',
					 width: 100,
					title: 'subtotal',         
				},
				{
					field: 'tax',
					 width: 100,
					title: 'tax',         
				},
				{
					field: 'total',
					 width: 100,
					title: 'total',         
				},
				
			 /* {
                field: 'Attachment',
                title: 'View Creditnote',
				 width: 100,
                template: function(row) {
					
					
                	
                    return '<a href="'+row.Attachment+'"  target="_blank"> view</a>' ; 
                },
            },  */
				
				
           ],

        });
		
         $('#kt_datatable_search_month').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'current_month');
		
        });
		
		 $('#kt_datatable_search_status').selectpicker();
      
    };
	
	
	/******************************************************/
	var SetUp =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/invoiceProduct",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [/* {
					field: '',
					title: '',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				}, */  
				
				{
					field: 'email',
					 width: 250,
					title: 'email',         
				},
				{
					field: 'AllEmails',
					 width: 200,
					title: 'All Emails',         
				},
				{ 
					field: 'date',
					 width: 200,
					title: 'date',         
				},
				
				
					
            ],

        });
	
    };
	/*****************************************************/
	var pdfview =	 function(orderNo) {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/AssociatedInvoice/"+orderNo,
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'vendor_name',
					 width: 150,
					title: 'Supplier Name',         
				},
				{
					field: 'order_number',
					 width: 140,
					title: 'Order N0.',         
				},
				
				
				
			
				 {
					field: 'document_number',
					 width: 90,
					title: 'Invoice N0.',
                    template: function(row) {
                    return '<a href="pdfview/'+row.id+'/'+row.order_number+'">'+row.document_number+'</a>' ;
                },	
				}, 
				{
					field: 'invoice_date',
					 width: 100,
					title: 'Invoice Date',         
				},
				
				
				{
					field: 'subtotal',
					 width: 90,
					title: 'subtotal',         
				},
				{
					field: 'tax',
					 width: 90,
					title: 'tax',         
				},
				{
					field: 'total',
					 width: 90,
					title: 'total',         
				},
				 /* {
                field: 'Attachment',
                title: 'View Invoice ',
				 width: 100,
                template: function(row) {
                    return '<a href="'+row.Attachment+'"  target="_blank"> view</a>' ;
                },
            },  */ 
			
				
					
           ],

        });
		
        
        $('#kt_datatable_search_month').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'current_month');
		
        });
		
		 $('#kt_datatable_search_status').selectpicker();
    };
	/****************************global suplieers******************************/
		
	
	var GlobalSupliers =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchAllGlobalSuppliers",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [
				 {
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: 'kt_datatable_checkbox_value'
					},
					textAlign: 'center',
				}, 
				
				{
					field: 'Supliers_logo',
					 width: 150,
					title: 'Logo',
						 template: function(row) {                   
						return  '<img src=' +row.Supliers_logo+ ' width="150px" heigth="150px">'; 
					},
				}, 
				
				{
                field: 'Supliers_Name',
				 width: 150,
                title: 'Supplier Name',
                 },
				 
				 {
                field: 'date',
				 width: 150,
                title: 'Date/Time',
                 },
					
             {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="EditSingleSuplier/'+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                        <a href="DeleteSingleSuplier/'+row.id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\
                    ';
                },            
            }],

        });
		 
		/*****************open****************/
         
	     
        $('#kt_datatable_search_month').on('change', function() {
				
            datatable.search($(this).val().toLowerCase(), 'Supliers_Name');
		
        });
          };
		
	/***********************************************************/
	var Statement =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchAllStatement",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: '',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'vendor_name',
					 width: 120,
					title: 'Supplier',         
				},
				{
					field: 'inovie_count',
					 width: 100,
					title: 'Invoice Count',         
				},
				{
					field: 'inovie_match',
					 width: 100,
					title: 'Invoice Match',         
				},
				{
					field: 'invoice_not_processed',
					 width: 200,
					title: 'Invoice Not Processed',         
				},
				
				{
					field: 'Attachment_id',
					 width: 140,
					title: 'Action',
						 template: function(row) {                   
						 return '<a href="ViewStatements/'+row.Attachment_id+'">View Statement</a>' ;
					},
				}],
					
         

        });
		
		 
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	/***********************************************************/   
	var ViewStatements =	 function(statementid) {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/FetchViewStatement/"+statementid,
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: '',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'statement_no',
					 width: 100,
					title: 'Statement No.',         
				},
				{
					field: 'procurehq_item',
					 width: 100,
					title: 'Procurehq Item',         
				},
				{
					field: 'project',
					 width: 100,
					title: 'project',         
				},
				{
					field: 'sub_total',
					 width: 100,
					title: 'Sub Total',         
				},
				{
					field: 'vat',
					 width: 100,
					title: 'Vat',         
				},
				{
					field: 'sub_total',
					 width: 100,
					title: 'Sub Total',         
				},
				{
					field: 'total',
					 width: 100,
					title: 'Total',         
				},
				{
					field: 'approve',
					 width: 100,
					title: 'Approve',         
				},
				{
					field: 'accounting_software_entery',
					 width: 200,
					title: 'Accounting Software Entery',         
				},
				{
					field: 'status',
					 width: 100,
					title: 'Status',         
				}],
					
         

        });
		
		 
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	
	
	
	/**********************************************************/
	
		/*********************filter page*********************/
	var fillter =	 function() {
		
        var datatable = $('#kt_datatable').KTDatatable({
				// datasource definition
				data: {
					type: 'remote',
					source:"https://app.pickmyorder.co.uk/NewThemeFillter",
					pageSize: 10,
				},

				// layout definition
				layout: {
					scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
					footer: false // display/hide footer
				},

				// column sorting
				sortable: true,            

				pagination: true,

				search: {
					input: $('#kt_datatable_search_query'),
					key: 'generalSearch'
				},

				// columns definition
				columns: [{
					field: 'id',
					title: 'id',
					sortable: false,
					width: 20,
					type: 'number',
					selector: {
						class: ''
					},
					textAlign: 'center',
				},
				
				{
					field: 'cat',
					 width: 150,
					title: 'Category Name',         
				},
				
					
            {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                autoHide: false,
                overflow: 'visible',
                template: function(row) {  
					var host = window.location.host; 
				   
                    return '\
                       \
                        <a href="editfillter?id='+row.id+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                            <span class="svg-icon svg-icon-md">\
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                        <rect x="0" y="0" width="24" height="24"/>\
                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                    </g>\
                                </svg>\
                            </span>\
                        </a>\ ';
                },            
            }],

        });
		
		 
        
        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
    };
	      
	
    return {
        // public functions
        init: function() {
			var url = window.location.href; 
			var myarr = url.split("/");
			var index=myarr.length;

			/***************************Function for OrderUnderProject page******************************************/
				var str = myarr[index-1];
				var n = str.indexOf("UnderProject");
				if(n>0)
				{
				  var orderUnder=str.split("=");
				  orderUnderProject(orderUnder[1]); 
				}
		   /*********************************************************************************************************/
		   
		        var strr = myarr[index-3];
				   if(strr=='pdfview')
				{
					 var orderNo = myarr[index-1];
					 pdfview(orderNo);  		
				}   
				 
				
				
				if(/SubCategory/i.test(myarr[index-1]))
				{
					
				  var catid=str.split("=");  
				  SubCategory(catid[1]);
				 
				}
				
				if(/InvoiceUnderProject/i.test(myarr[index-2]))
				{
						var InvoiceId = str.split('/');
						InvoiceUnderProject(InvoiceId);
                      
						
				}
				
				if(myarr[index-1]=="business")
				{
					business();
				}
				
				if(myarr[index-1]=="Advertisment")
				{
					Advertisment();
				}
				
				if(myarr[index-1]=="Invoice")
				{
					Invoice();
				}
				
				if(myarr[index-1]=="Quotation")
				{
					Quotation();
				}
				if(myarr[index-1]=="invoiceIndividualDetails")
				{
					invoiceIndividualDetails();
				}
				
				if(myarr[index-1]=="Creditnote")
				{
					Creditnote();
				}
				
				if(myarr[index-1]=="TrialBusiness")
				{
					TrialBusiness();
				}
				
				if(myarr[index-1]=="users")
				{ 
					users();
				}
				if(myarr[index-1]=="suppliers")
				{ 
					supplier();
				}
				if(myarr[index-1]=="projects")
				{ 
					Projects();
				}
				if(myarr[index-1]=="engineer")
				{ 
					Engineer();
				}
				if(myarr[index-1]=="wholesaler")
				{
					
					WholsalerEnginer();
				}
				if(myarr[index-1]=="Delevercost")
				{
					
					DeleveryCost();
			    }
				if(myarr[index-1]=="Stores")
				{
				
					Stores();
			    }
				if(myarr[index-1]=="ProductList")
				{
				 
					ProductsList();
			    }
				if(myarr[index-1]=="CategoryList")
				{

					CategoryList();
			    }
				if(myarr[index-1]=="orders")
				{
					
					Order();
				}
				if(myarr[index-1]=="quotes")
				{
					
					Quotes();
				}
				if(myarr[index-1] == "productCatalogue")
				{
					productCatalogue();
				}
				if(myarr[index-1]=="AwtingOrderView")
				{
					
					AwatingOrders();
				}
				if(myarr[index-1]=="products")
				{
					
					product();
				}
				if(myarr[index-1]=="vanstock")
				{
					
					vanstock();
				}
				if(myarr[index-1]=="Vans")
				{
					Vans();
				}
				if(myarr[index-1]=="Notifictions")
				{
					Notifictions();
				}
				if(myarr[index-1]=="category")  
				{
					category();
				}
				
				if(myarr[index-1]=="SetUp")  
				{
					SetUp();
				}
				
				if(/SubCategory/i.test(myarr[index-1]))
				{
					
				  var catid=str.split("=");  
				  SubCategory(catid[1]);
				 
				}
				
				if(/superSubCategory/i.test(myarr[index-2]))
				{
						var stuff = str.split('/');
						superSubCategory(stuff);
				}
				
				if(/ViewStatements/i.test(myarr[index-2]))
				{
						var statementid = str.split('/');
						ViewStatements(statementid);
				}
				
				
				
				if(/ManageListProducts/i.test(myarr[index-3]))
				{
						var stuff = str.split('/');
						
					 		if(myarr[index-2]!='null')
							{
								var text2=myarr[index-2];
								ManageListProducts(stuff,text2);
								
							}
                            else
							{
								 var text2='null';
								ManageListProducts(stuff,text2);
							}								
						    
						     
						
						
						
				}
				
				
				
				
				
                if(myarr[index-1]=="categoryLists")  
				{
					categoryLists();
				}
				if(myarr[index-1]=="fillter")
				{
					
					fillter();
				}
				
				if(myarr[index-1]=="ReorderProducts")
				{
					
					ReorderProducts();
				}
				
				
				
				if(myarr[index-1]=="Statement")
				{
					Statement();
				}
				
				if(myarr[index-1]=="LukinsFailureProducts")
				{
					
					LukinsFailureProducts();
				}
                if(myarr[index-1]=="GlobalSupliers")
				{
					
					GlobalSupliers();
				}
				if(/vanAllProducts/i.test(myarr[index-1]))
				{
					
				  var vanID=str.split("=");
				  vanAllProducts(vanID[1]);
				 
				}
			      
				if(/VanEngineers/i.test(myarr[index-1]))
				{
					
				  var vanID=str.split("=");
				  VanEngineers(vanID[1]);
				 
				}
				
				if(/VanAllOrder/i.test(myarr[index-1]))
				{
					
				  var vanID=str.split("=");
				  VanAllOrder(vanID[1]);
				 
				}
				
				 if(/AddCategoryInListCategory/i.test(myarr[index-1]))
				{
					
				  var ListId=str.split("=");
				  AddCategoryInListCategory(ListId[1]);
				 
				} 
				
				
				
				
        }
    };
}();      

jQuery(document).ready(function() {
    KTDatatableJsonRemoteDemo.init();
});
