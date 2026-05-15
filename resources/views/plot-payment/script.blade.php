@push('scripts')
    <script>
        $(document).ready(function() {

            // Customer dropdown auto load
            $('#customerSelect').on(
                'change',
                function() {

                    if ($(this).val()) {

                        $('#bookingFilterForm')
                            .submit();

                    }

                }
            );


            function resetFields() {

                $('.emi-field').addClass('d-none');
                $('.bank-field').addClass('d-none');
                $('.cheque-field').addClass('d-none');
                $('.dd-field').addClass('d-none');
                $('.transaction-field').addClass('d-none');

            }


            function toggleFields() {

                resetFields();

                let planType =
                    $('#planType').val();

                let paymentMode =
                    $('#paymentMode').val();


                if (planType === 'emi_plan') {

                    $('.emi-field')
                        .removeClass('d-none');

                }


                if (
                    paymentMode === 'cheque' ||
                    paymentMode === 'dd' ||
                    paymentMode === 'neft_rtgs'
                ) {

                    $('.bank-field')
                        .removeClass('d-none');

                }


                if (paymentMode === 'cheque') {

                    $('.cheque-field')
                        .removeClass('d-none');

                }


                if (paymentMode === 'dd') {

                    $('.dd-field')
                        .removeClass('d-none');

                }


                if (
                    paymentMode === 'neft_rtgs' ||
                    paymentMode === 'card'
                ) {

                    $('.transaction-field')
                        .removeClass('d-none');

                }

            }


            function calculateAmounts() {

                let total =
                    parseFloat(
                        $('#totalPlotCost').val()
                    ) || 0;

                let booking =
                    parseFloat(
                        $('#bookingAmount').val()
                    ) || 0;

                let months =
                    parseInt(
                        $('#emiMonths').val()
                    ) || 0;


                let due = total - booking;

                if (due < 0) {

                    due = 0;

                }


                $('#dueAmount')
                    .val(
                        due.toFixed(2)
                    );


                if (
                    $('#planType').val() === 'emi_plan' &&
                    months > 0
                ) {

                    $('#emiAmount')
                        .val(
                            (due / months)
                            .toFixed(2)
                        );

                } else {

                    $('#emiAmount')
                        .val('');

                }

            }


            $('#planType').change(function() {

                toggleFields();

                calculateAmounts();

            });


            $('#paymentMode').change(
                toggleFields
            );


            $('#bookingAmount, #emiMonths')
                .on(
                    'keyup change',
                    calculateAmounts
                );


            toggleFields();

            calculateAmounts();

        });
    </script>
@endpush
