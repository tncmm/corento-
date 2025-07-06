'use strict';

class CustomerAutocomplete {
    constructor() {
        this.init();
        this.handleEvents();
    }

    init() {
        this.customerSearchInput = $('#customer_search');
        this.customerSearchResults = $('#customer_search_results');
        this.selectedCustomerInfo = $('#selected_customer_info');
        this.customerIdInput = $('#customer_id');
        this.createNewCustomerBtn = $('#btn_create_new_customer');
        this.searchUrl = route('car-rentals.bookings.search-customers');
        this.getCustomerUrl = route('car-rentals.bookings.get-customer');
        this.customerFields = [
            'name',
            'email',
            'phone',
            'customer_age',
            'country',
            'state',
            'city',
            'address',
            'zip'
        ];
    }

    handleEvents() {
        let _self = this;

        // Handle search input
        this.customerSearchInput.on('keyup', function() {
            const keyword = $(this).val();

            if (keyword.length < 1) {
                _self.customerSearchResults.hide();
                return;
            }

            _self.searchCustomers(keyword);
        });

        // Handle clicking outside the search results
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#customer_search_results, #customer_search').length) {
                _self.customerSearchResults.hide();
            }
        });

        // Handle create new customer button
        this.createNewCustomerBtn.on('click', function() {
            // Show the modal
            $('#create-customer-modal').modal('show');
        });

        // Handle create customer form submission
        $('#create-customer-button').on('click', function() {
            _self.createCustomer();
        });

        // Handle modal hidden event
        $('#create-customer-modal').on('hidden.bs.modal', function() {
            // Clear form fields
            $('#create-customer-form')[0].reset();
            $('#modal-error-msg').addClass('d-none').html('');
        });
    }

    createCustomer() {
        let _self = this;
        let formData = {
            name: $('#modal_name').val(),
            email: $('#modal_email').val(),
            phone: $('#modal_phone').val(),
            customer_age: $('#modal_customer_age').val(),
            address: $('#modal_address').val(),
            city: $('#modal_city').val(),
            state: $('#modal_state').val(),
            country: $('#modal_country').val(),
            zip: $('#modal_zip').val()
        };

        // Show loading state
        $('#create-customer-button').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Creating...');
        $('#modal-error-msg').addClass('d-none').html('');

        $.ajax({
            url: route('car-rentals.bookings.create-customer'),
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                if (res.error) {
                    $('#modal-error-msg').removeClass('d-none').html(res.message);
                } else {
                    // Close the modal
                    $('#create-customer-modal').modal('hide');

                    // Update the customer info
                    const customer = res.data.customer;
                    _self.selectedCustomerInfo.html(res.data.html).show();
                    _self.fillCustomerFields(customer);
                    _self.customerIdInput.val(customer.id);
                    _self.customerSearchInput.val(`${customer.name}`);
                    $('#booking_details_container').removeClass('d-none');

                    // Show success message
                    Botble.showSuccess(res.data.message);
                }
            },
            error: function(error) {
                $('#modal-error-msg').removeClass('d-none').html('Error creating customer: ' + error.responseJSON.message);
            },
            complete: function() {
                // Reset button state
                $('#create-customer-button').prop('disabled', false).html('Create Customer');
            }
        });
    }

    searchCustomers(keyword) {
        let _self = this;

        // Show loading indicator
        this.customerSearchResults.html('<div class="dropdown-item">Loading...</div>').show();

        $.ajax({
            url: this.searchUrl,
            type: 'GET',
            data: {
                q: keyword
            },
            success: function(res) {
                _self.renderSearchResults(res.data);
            },
            error: function(error) {
                console.error('Error searching customers:', error);
                _self.customerSearchResults.html('<div class="dropdown-item">Error loading results</div>');
            }
        });
    }

    renderSearchResults(data) {
        let _self = this;

        // Use the HTML rendered by the server
        this.customerSearchResults.html(data.html).show();

        if (!data.html || data.html.trim() === '') {
            this.customerSearchResults.html('<div class="dropdown-item">No results found</div>');
        }

        // Handle customer selection
        $('.customer-item').on('click', function() {
            const customerId = $(this).data('id');
            _self.selectCustomer(customerId);
            _self.customerSearchResults.hide();
        });
    }

    selectCustomer(customerId) {
        let _self = this;

        $.ajax({
            url: this.getCustomerUrl,
            type: 'GET',
            data: {
                id: customerId
            },
            success: function(res) {
                if (res.error) {
                    Botble.showError(res.message);
                } else {
                    const customer = res.data.customer;
                    // Use the HTML rendered by the server
                    _self.selectedCustomerInfo.html(res.data.html).show();
                    _self.fillCustomerFields(customer);
                    _self.customerIdInput.val(customer.id);
                    _self.customerSearchInput.val(`${customer.name}`);
                    $('#booking_details_container').removeClass('d-none');
                }
            },
            error: function(error) {
                console.error('Error getting customer:', error);
            }
        });
    }

    fillCustomerFields(customer) {
        this.customerFields.forEach(function(field) {
            if (customer[field]) {
                $(`#${field}`).val(customer[field]);
            }
        });
    }

    clearCustomerSelection() {
        this.customerFields.forEach(function(field) {
            $(`#${field}`).val('');
        });
    }
}

$(document).ready(function() {
    new CustomerAutocomplete();
});
