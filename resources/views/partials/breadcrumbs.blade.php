<div class="section-header-breadcrumb">

    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <div class="breadcrumb-item active">
                <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
            </div>

           
        @else
            <div class="breadcrumb-item">{{ $breadcrumb->title }}</div>
        @endif
    @endforeach    
</div>