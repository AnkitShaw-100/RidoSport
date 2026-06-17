<div class="brand-area">
    <div class="row">
        <div class="section-title text-left" style="margin: 20px 0 0 0;">
            <h1 class="section-main-title" style="text-transform: uppercase">Our <span>Clients</span></h1>
        </div>
        <div class="brand_list owl-carousel">
            @foreach($clients as $client) <!-- Loop through the clients -->
                <div class="col-lg-12">
                    <div class="brand-box">
                        <div class="brand-thumb">
                            <img src="{{ url($client->image_path) }}" alt="{{ $client->name }}" > <!-- Dynamically show client image and alt text -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
