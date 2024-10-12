{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
<x-backpack::menu-dropdown title="الاساتذة" icon="las la-clinic-medical" :withColumns="true">
        <x-theme-tabler::menu-dropdown-column>
                <x-backpack::menu-dropdown-item title="الاساتذة" icon="las la-chalkboard-teacher" :link="backpack_url('teacher')" />
                <x-backpack::menu-dropdown-item title="الاوقات المتاحة للاستاذ" icon="las la-clock" :link="backpack_url('time')" />
                <x-backpack::menu-dropdown-item title="التخصصات" icon="las la-shield-alt" :link="backpack_url('specialization')" />
        </x-theme-tabler::menu-dropdown-column>
</x-backpack::menu-dropdown>

<x-backpack::menu-dropdown title="الطلاب" icon="las la-clinic-medical" :withColumns="true">
        <x-theme-tabler::menu-dropdown-column>
                <x-backpack::menu-dropdown-item title="الطلاب" icon="las la-user-graduate" :link="backpack_url('student')" />
                <x-backpack::menu-dropdown-item title="الاوقات المفضلة للطلاب" icon="las la-clock" :link="backpack_url('perfect-time')" />
        </x-theme-tabler::menu-dropdown-column>
</x-backpack::menu-dropdown>

<x-backpack::menu-item title="الكورسات" icon="las la-chalkboard" :link="backpack_url('course')" />
<x-backpack::menu-item title="البلاد" icon="las la-flag" :link="backpack_url('country')" />
<x-backpack::menu-item title="الايام" icon="las la-calendar-day" :link="backpack_url('day')" />
<x-backpack::menu-item title="المواد" icon="las la-book-open" :link="backpack_url('subject')" />

<x-backpack::menu-dropdown title="الصلاحيات" icon="las la-clinic-medical" :withColumns="true">
        <x-theme-tabler::menu-dropdown-column>
                <x-backpack::menu-dropdown-item title="الصلاحيات" icon="las la-check-square" :link="backpack_url('employee')" />
                <x-backpack::menu-dropdown-item title="المهام" icon="las la-calendar-check" :link="backpack_url('task')" />
        </x-theme-tabler::menu-dropdown-column>
</x-backpack::menu-dropdown>