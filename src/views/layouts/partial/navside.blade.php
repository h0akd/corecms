<?php
$modules = array_merge($systems, array());
$i = 0
?>
@foreach ($modules as $module)
<li class="dropdown">
    <a href="#" class="dropdown-toggle">
        <div class="left-diver"></div>
        <i class="fa fa-home"></i> 
        {{$module['name']}}
    </a>
    <ul class="dropdown-menu">
        <li>
            @foreach ($module['childs'] as $child)
            <a href="#" data-id="{{$i}}" 
               data-title="{{$child['tab-title']}}" 
               data-url="{{$child['url']}}" 
               data-togle="create-tab">
                <i class="fa fa-edit"  ></i> 
                {{$child['menu-title']}}
            </a>
             <?php $i++ ?>
            @endforeach
        </li>            

    </ul>
</li>
@endforeach