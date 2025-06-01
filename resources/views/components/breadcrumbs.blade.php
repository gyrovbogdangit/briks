 <nav class="breadcrumbs" aria-label="breadcrumb">
     <ol class="breadcrumb">
         @foreach ($breadcrumbs as $item)
             <li class="breadcrumb-item" @if ($loop->last) aria-current="page" @endif>
                 <a href="{{ $item['url'] }}" class="text-muted text-decoration-none">{{ $item['name'] }}</a>
             </li>
         @endforeach
     </ol>
 </nav>
