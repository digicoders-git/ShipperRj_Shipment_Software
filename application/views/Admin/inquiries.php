<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php
    include("inc/header-link.php")
        ?>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <script>
        NProgress.configure({ showSpinner: false });
        NProgress.start();
    </script>
    <div id="toaster"></div>

    <div class="wrapper">
        <?php
        include("inc/sidebar.php")
            ?>

        <div class="page-wrapper">
            <?php
            include("inc/header.php")
                ?>

            <div class="content-wrapper">
                <div class="content">
                    <div class="card card-default">
                        <div class="card-header">
                            <h2>Contact Inquiries</h2>
                        </div>
                        <div class="card-body">
                            <table id="inquiriesTable" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S no</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sr = 1;
                                    if (!empty($inquiries)) {
                                        foreach ($inquiries as $item) {
                                            ?>
                                            <tr>
                                                <td><?= $sr ?></td>
                                                <td><?= $item->name ?></td>
                                                <td><?= $item->email ?></td>
                                                <td><?= $item->mobile ?></td>
                                                <td><?= $item->subject ?></td>
                                                <td><?= date('d-M-Y h:i A', strtotime($item->created_at)) ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary btn-pill"
                                                        onclick="viewMessage('<?= htmlspecialchars($item->name) ?>', '<?= htmlspecialchars(json_encode($item->message)) ?>')"
                                                        title="View Message">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger btn-pill"
                                                        onclick="Deletedata('contact_inquiry', '<?= $item->id ?>')"
                                                        title="Delete">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $sr++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include("inc/footer.php")
                ?>
        </div>
    </div>

    <!-- Message View Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalName">Message from User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-bold mb-2">Message:</p>
                    <div id="modalMessage" class="p-3 bg-light rounded text-dark" style="white-space: pre-wrap;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("inc/footer-link.php")
        ?>

    <script>
        function viewMessage(name, message) {
            // Message is JSON encoded from PHP to handle newlines
            const cleanMessage = JSON.parse(message);
            $('#modalName').text('Message from ' + name);
            $('#modalMessage').text(cleanMessage);
            $('#messageModal').modal('show');
        }

        $(document).ready(function () {
            $('#inquiriesTable').DataTable({
                "order": [[0, "desc"]]
            });
        });

        function Deletedata(table, id) {
            swal({
                title: "Are you sure?",
                text: "You want to delete this inquiry!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url('Admin/Deletedata') ?>',
                        type: 'POST',
                        data: {
                            table: table,
                            id: id
                        },
                        success: function (res) {
                            if (res == true) {
                                swal("Deleted successfully!", {
                                    icon: "success",
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                swal("Failed to delete!", {
                                    icon: "error",
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>