<?= $this->extend('Admin/layout') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Basic Tables </h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="search-container">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search for customers, status, etc.">
                </div>

                <div class="card-body table-responsive p-3">
                    <h4 class="card-title">Bordered table</h4>
                    <table id="subscriptionTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer Name</th>
                                <th>Remaining Days</th>
                                <th>Expiry Date</th>
                                <th>Customer Email</th>
                                <th>Action</th> <!-- Add Action column for the Detail button -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($subscription as $sub): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($sub['nama_lengkap']) ?></td>
                                    <td>
                                        <?php 
                                        if ($sub['remaining_days'] > 0) {
                                            echo esc($sub['remaining_days']) . ' days remaining';
                                        } elseif ($sub['remaining_days'] < 0) {
                                            echo 'Expired';
                                        } else {
                                            echo 'Belum Di Set';
                                        }
                                        ?>
                                    </td>
                                    <td><?= esc($sub['expirated_date'] ?? 'Not Set') ?></td>
                                    <td><?= esc($sub['email']) ?></td>

                                    <td>
                                        <!-- Detail Button -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="<?= $sub['id'] ?>" data-customer="<?= esc($sub['nama_lengkap']) ?>" data-expiry="<?= esc($sub['expirated_date']) ?>" data-remaining="<?= esc($sub['remaining_days']) ?>">Detail</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Subscription Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Subscription Details Content -->
                <p><strong>Customer Name:</strong> <span id="customerName"></span></p>
                <p><strong>Customer Email:</strong> <span id="customerEmail"></span></p>
                <p><strong>Expiry Date:</strong> <span id="expiryDate"></span></p>
                <p><strong>Remaining Days:</strong> <span id="remainingDays"></span></p>
                <p><strong>Status:</strong> <span id="status"></span></p>
                <p><strong>Package:</strong> <span id="packageName"></span></p>
                <p><strong>Order Date:</strong> <span id="orderDate"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Script to Handle Modal Data -->
<script>
    // Handle modal popup data
    $('#detailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var customerName = button.data('customer');
        var expiryDate = button.data('expiry');
        var remainingDays = button.data('remaining');
        
        // Populate modal fields
        $('#customerName').text(customerName);
        $('#expiryDate').text(expiryDate);
        $('#remainingDays').text(remainingDays + ' days remaining');
        
        // Set the status based on remaining days
        var status = remainingDays > 0 ? 'Active' : (remainingDays < 0 ? 'Expired' : 'Expired Today');
        $('#status').text(status);

        // Here you can add more data like package name, order date, etc., if available
        // Example (this assumes your data contains a field for 'package_name' and 'order_date'):
        // $('#packageName').text(button.data('package'));
        // $('#orderDate').text(button.data('orderdate'));
    });
</script>

<script>
    $(document).ready(function() {
        // Event listener for input search
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase(); // Get input and convert to lowercase
            $("#subscriptionTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1); // Filter the table based on the search input
            });
        });
    });
</script>

<?= $this->endSection() ?>
