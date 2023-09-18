<div class="sc-working-process-area sc-pt-120 sc-pb-120" id="syarat" data-sal="fade-in" data-sal-duration="800" data-sal-delay="200">
    <div class="container">
        <div class="table-responsive mt-1">
            <table class="table select-table table-hover" id="sarpras">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Sarana dan Prasarana</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sarpras as $key => $s)
                    <tr>
                        <td><h6>{{ $key+1 }}</h6></td>
                        <td>
                            <h6>{{ $s->jenis_sarpras }}</h6>
                        </td>
                        <td>
                            <h6>{{ $s->jumlah }}</h6>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>