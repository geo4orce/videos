<?php

/**
 * @var string $active_page current route
 */

$tabs = ['home', 'mine', 'upload'];

?>
<ul class="nav nav-tabs">
    @foreach($tabs as $tab)
        <li class="nav-item">
            <a
                class="nav-link {{$tab == $active_page ? 'active' : ''}}"
                href="/{{$tab}}"
            >{{ucfirst($tab)}}</a>
        </li>
    @endforeach
</ul>
