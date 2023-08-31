<?= $this->extend('layouts/app');?>

<?= $this->section('page_title');?>
Dashboard
<?= $this->endSection();?>

<?= $this->section('content');?>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-primary notif" role="alert"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="col-12 col-md-6 col-lg-6">
    <div class="card">
        <div class="card-header">
            <h4>Grafik Transaksi</h4>
        </div>
        <div class="card-body">
            <div class="">
                <canvas id="myChart"></canvas>
            </div>
    
        </div>
    </div>
</div>

<?= $this->endSection();?>

<?= $this->section('script');?>
<script>
    function renderSpeciesChart() {
        $.ajax({
            url: '<?= base_url('getTrx')?>',
            type: 'get',
            dataType: 'json',
            success: function(response) {
                let label = [];
                let output = [];

                response.forEach(element => {
                    label.push(element.bulan);
                    output.push(element.total);
                });

                const ctx = document.getElementById('myChart');
                const labels = label;
                const data = {
                labels: labels,
                datasets: [{
                    label: 'Total Transaksi',
                    data: output,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
                };
                // const config = {
                //     type: 'bar',
                //     data: data,
                //     options: {
                //         scales: {
                //         y: {
                //             beginAtZero: true
                //         }
                //         }
                //     },
                // };
                // const data = {
                //     labels: [
                //         'Red',
                //         'Blue',
                //         'Yellow'
                //     ],
                //     datasets: [{
                //         label: 'My First Dataset',
                //         data: [
                //             300, 
                //             50, 
                //             100
                //         ],
                //         backgroundColor: [
                //             'rgb(255, 99, 132)',
                //             'rgb(54, 162, 235)',
                //             'rgb(255, 205, 86)'
                //         ],
                //         hoverOffset: 4
                //     }]
                // };
                
                new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                        y: {
                            beginAtZero: true
                        }
                        }
                    },
                });
            }
        });
    }

    $(document).ready(function() {
        renderSpeciesChart();
        renderRasChart(); 
    });

</script>
<?= $this->endSection();?>