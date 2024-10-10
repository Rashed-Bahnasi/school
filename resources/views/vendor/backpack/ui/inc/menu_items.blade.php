{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Teachers" icon="las la-chalkboard-teacher" :link="backpack_url('teacher')" />
<x-backpack::menu-item title="Available Times" icon="las la-clock" :link="backpack_url('time')" />
<x-backpack::menu-item title="Students" icon="las la-user-graduate" :link="backpack_url('student')" />
<x-backpack::menu-item title="Perfect times" icon="la la-question" :link="backpack_url('perfect-time')" />
<x-backpack::menu-item title="Courses" icon="las la-chalkboard" :link="backpack_url('course')" />
<x-backpack::menu-item title="Countries" icon="las la-flag" :link="backpack_url('country')" />
<x-backpack::menu-item title="Days" icon="las la-calendar-day" :link="backpack_url('day')" />
<x-backpack::menu-item title="Subjects" icon="la la-question" :link="backpack_url('subject')" />
<x-backpack::menu-item title="Employees" icon="la la-question" :link="backpack_url('employee')" />
<x-backpack::menu-item title="Tasks" icon="la la-question" :link="backpack_url('task')" />