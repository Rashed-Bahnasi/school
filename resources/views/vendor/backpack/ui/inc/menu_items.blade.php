{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Students" icon="las la-user-graduate" :link="backpack_url('student')" />
<x-backpack::menu-item title="Countries" icon="las la-flag" :link="backpack_url('country')" />