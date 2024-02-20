<!doctype html>
<html lang="en">
<head><base href="../">
    <title>Mine</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
{{--    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />--}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="manifest" href="/manifes.json"/>
</head>
<body data-kt-name="metronic" id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<div id="app">
    <router-view></router-view>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/js/app.js"></script>
<script src="/assets/plugins/global/plugins.bundle.js"></script>
<script src="/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
<script src="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
<script src="/assets/js/widgets.bundle.js"></script>
<script src="/assets/js/custom/widgets.js"></script>
{{--<script src="/assets/js/custom/apps/chat/chat.js"></script>--}}
{{--<script src="/assets/js/custom/utilities/modals/upgrade-plan.js"></script>--}}
{{--<script src="/assets/js/custom/utilities/modals/create-app-1.js"></script>--}}
{{--<script src="/assets/js/custom/utilities/modals/users-search.js"></script>--}}

{{--<script>--}}
{{--    if ('serviceWorker' in navigator) {--}}
{{--        window.addEventListener('load', () => {--}}
{{--            navigator.serviceWorker.register('/firebase-messaging-sw.js');--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
</body>
</html>
