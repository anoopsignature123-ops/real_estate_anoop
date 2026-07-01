<div class="col-lg-5">
    <div class="emi-summary-card sticky-top">
        <div class="emi-summary-loader d-none" id="emi_summary_loader">
            <div class="emi-loader-box">
                <span class="spinner-border spinner-border-sm text-success" role="status" aria-hidden="true"></span>
                <strong>Loading EMI details...</strong>
            </div>
        </div>

        <div class="emi-summary-head">
            <span class="emi-summary-icon">
                <i class="bi bi-calendar2-check"></i>
            </span>
            <div>
                <h4 class="fw-bold mb-1 text-dark">EMI Summary</h4>
                <small class="text-muted">Installment and payment details</small>
            </div>
        </div>

        <div class="emi-summary-grid">
            <div class="emi-summary-box">
                <small>Total Plot Cost</small>
                <strong>&#8377;<span id="total_cost">0.00</span></strong>
            </div>

            <div class="emi-summary-box primary">
                <small>Booking Amount</small>
                <strong>&#8377;<span id="booking_amount">0.00</span></strong>
            </div>

            <div class="emi-summary-box success">
                <small>Confirmed Paid</small>
                <strong>&#8377;<span id="total_paid">0.00</span></strong>
            </div>

            <div class="emi-summary-box warning">
                <small>Hold Amount</small>
                <strong>&#8377;<span id="hold_amount">0.00</span></strong>
            </div>

            <div class="emi-summary-box info">
                <small>Monthly EMI</small>
                <strong>&#8377;<span id="monthly_emi">0.00</span></strong>
                <button type="button" class="btn btn-sm btn-outline-info mt-2 w-100 d-none" id="fill_monthly_emi">
                    <i class="bi bi-calendar-check me-1"></i> Pay Current EMI
                </button>
            </div>

            <div class="emi-summary-box danger">
                <small>Due Amount</small>
                <strong>&#8377;<span id="due_amount">0.00</span></strong>
                <button type="button" class="btn btn-sm btn-outline-danger mt-2 w-100 d-none" id="fill_due_amount">
                    <i class="bi bi-cash-stack me-1"></i> Pay Full Due
                </button>
            </div>
        </div>

        <div class="emi-progress-box mb-3">
            <div>
                <small>EMI Start Date</small>
                <strong id="emi_start_date">-</strong>
            </div>
            <div>
                <small>EMI Progress</small>
                <strong id="emi_months">0 / 0 Months</strong>
            </div>
        </div>

        <div class="emi-view-box mb-3 d-none" id="emi_view_box">
            <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                <div>
                    <h6 class="fw-bold mb-1">View EMI</h6>
                    <small class="text-muted">Total EMI, paid EMI and remaining EMI for selected booking.</small>
                </div>
                <span class="badge bg-success-subtle text-success border" id="emi_view_total_badge">0 EMI</span>
            </div>

            <div class="emi-view-stats">
                <div>
                    <small>Total EMI</small>
                    <strong id="emi_view_total">0</strong>
                </div>
                <div class="success">
                    <small>Paid</small>
                    <strong id="emi_view_paid">0</strong>
                </div>
                <div class="warning">
                    <small>Hold</small>
                    <strong id="emi_view_hold">0</strong>
                </div>
                <div class="danger">
                    <small>Remaining</small>
                    <strong id="emi_view_remaining">0</strong>
                </div>
            </div>

            <div class="progress emi-view-progress mt-3" role="progressbar" aria-label="EMI paid progress"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-success" id="emi_view_progress_bar" style="width: 0%"></div>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-2 small">
                <span class="text-muted fw-semibold">Paid progress</span>
                <strong class="text-success" id="emi_view_progress_text">0% Paid</strong>
            </div>
        </div>

        <div class="emi-history-box">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0">Payment History</h6>
                <span class="badge bg-light text-dark border" id="payment_history_count">0 Records</span>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0 emi-history-table">
                    <thead class="table-light">
                        <tr>
                            <th>Receipt</th>
                            <th>Plot</th>
                            <th>Date</th>
                            <th>Paid</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="payment_history">
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No Payment Found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
