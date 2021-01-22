
@if ($val == 'etape_1')
    <h2>{{ trans('app.home.step1.modal.title') }}</h2>
    <p>{{ trans('app.home.step1.modal.content') }}</p>

@elseif ($val == 'etape_2')
    <h2>{{ trans('app.home.step2.modal.title') }}</h2>
    <p>{{ trans('app.home.step2.modal.content') }}</p>

@elseif ($val == 'etape_3')
    <h2>{{ trans('app.home.step3.modal.title') }}</h2>
    <p>{{ trans('app.home.step3.modal.content') }}</p>

@elseif ($val == 'etape_4')
    <h2>{{ trans('app.home.step4.modal.title') }}</h2>
    <p>{{ trans('app.home.step4.modal.content') }}</p>

@endif