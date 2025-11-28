 <nav class="breadcrumbs" aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
     <ol class="breadcrumb">
         @foreach ($breadcrumbs as $item)
             <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" @if ($loop->last) aria-current="page" @endif>
                 <a href="{{ $item['url'] }}" class="text-muted text-decoration-none" itemprop="item">
                     <span itemprop="name">{{ $item['name'] }}</span>
                 </a>
                 <meta itemprop="position" content="{{ $loop->iteration }}" />
             </li>
         @endforeach
     </ol>
 </nav>
