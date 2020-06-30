@can('accept', $model)
    <a title="Click to mark as favorite" onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit()" class="{{ $model->status }} mt-2">
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form id="accept-answer-{{ $model->id }}" action="{{ route('answers.accept', $model->id) }}" method="POST" style="display: none">
        @csrf
    </form>
@else
    @if($model->is_best)
        <a title="The Question owner accepted this as the best answer" class="{{ $model->status }} mt-2">
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan
