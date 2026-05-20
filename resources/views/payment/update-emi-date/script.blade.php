@push('scripts')
    <script>
        $(document).ready(function() {
            function toggleBulkButton() {
                let selectedIds = [];
                $('.payment_checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    $('#bulk_update_btn').removeClass('d-none');
                    $('#payment_ids').val(selectedIds.join(','));
                } else {
                    $('#bulk_update_btn').addClass('d-none');
                    $('#payment_ids').val('');
                }
            }

            $('#select_all').change(function() {
                $('.payment_checkbox').prop('checked', $(this).is(':checked'));
                toggleBulkButton();
            });

            $(document).on('change', '.payment_checkbox', function() {
                toggleBulkButton();
                let totalCheckbox = $('.payment_checkbox').length;
                let checkedCheckbox = $('.payment_checkbox:checked').length;
                $('#select_all').prop('checked', totalCheckbox === checkedCheckbox);
            });

            $('.single_update_btn').click(function() {
                let paymentId = $(this).data('id');
                let emiDate = $('.single_emi_date[data-id="' + paymentId + '"]').val();

                if (!emiDate) {
                    alert('Please select EMI date first');
                    return;
                }

                $.ajax({
                    url: "{{ route('update-emi-date.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        payment_ids: paymentId,
                        emi_date: emiDate
                    },
                    success: function(response) {
                        alert('EMI date updated successfully');
                        location.reload();
                    },
                    error: function() {
                        alert('Something went wrong');
                    }
                });
            });
        });
    </script>
@endpush
