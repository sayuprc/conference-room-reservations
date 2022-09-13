import './bootstrap';

document.getElementById('theme-toggle')?.addEventListener('click', () => {
  if (document.documentElement.classList.contains('dark')) {
    document.documentElement.classList.remove('dark');
    document.getElementById('theme-toggle-light-icon').classList.add('hidden');
    document.getElementById('theme-toggle-dark-icon').classList.remove('hidden');

    localStorage.setItem('theme', 'light')
  } else {
    document.documentElement.classList.add('dark');
    document.getElementById('theme-toggle-light-icon').classList.remove('hidden');
    document.getElementById('theme-toggle-dark-icon').classList.add('hidden');

    localStorage.setItem('theme', 'dark')
  }
});

document.getElementById('reservation-delete-button')?.addEventListener('click', event => {
  event.preventDefault();

  if (confirm('削除します。よろしいですか？')) {
    document.getElementById('reservation-delete-form').submit();
  }
});

document.getElementById('add-hour-button')?.addEventListener('click', event => {
  event.preventDefault();

  const startAtDate = document.getElementById('start_at_date');
  const startAtTime = document.getElementById('start_at_time');

  const endAtDate = document.getElementById('end_at_date');
  const endAtTime = document.getElementById('end_at_time');

  // 基準となる開始日が設定されていないときは何もしない。
  if (startAtDate.value === '' || startAtTime === '') {
    return;
  }

  // 終了日時が空なら開始日をもとに計算する
  const isBaseStart = endAtDate.value === '' || endAtTime.value === '';
  const date = isBaseStart ? `${startAtDate.value}T${startAtTime.value}` : `${endAtDate.value}T${endAtTime.value}`;
  const base = new Date(date);

  // 1時間追加
  base.setHours(base.getHours() + 1);

  endAtDate.value = toyyyyMMdd(base);
  endAtTime.value = toHHmm(base);
});

document.getElementById('add-half-hour-button')?.addEventListener('click', event => {
  event.preventDefault();

  const startAtDate = document.getElementById('start_at_date');
  const startAtTime = document.getElementById('start_at_time');

  const endAtDate = document.getElementById('end_at_date');
  const endAtTime = document.getElementById('end_at_time');

  // 基準となる開始日が設定されていないときは何もしない。
  if (startAtDate.value === '' || startAtTime === '') {
    return;
  }

  // 終了日時が空なら開始日をもとに計算する
  const isBaseStart = endAtDate.value === '' || endAtTime.value === '';
  const date = isBaseStart ? `${startAtDate.value}T${startAtTime.value}` : `${endAtDate.value}T${endAtTime.value}`;
  const base = new Date(date);

  // 30分追加
  base.setMinutes(base.getMinutes() + 30)

  endAtDate.value = toyyyyMMdd(base);
  endAtTime.value = toHHmm(base);
});

function toyyyyMMdd(date) {
  return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;
}

function toHHmm(date) {
  return `${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
}

document.getElementById('template')?.addEventListener('change', event => {
  const selectedId = event.target.value;

  const templates = JSON.parse(localStorage.getItem('templates') ?? []);

  const template = templates.filter(item => item.templateId == selectedId)[0] ?? undefined;

  if (template != undefined) {
    const summary = document.getElementById('summary');
    const startAtTime = document.getElementById('start_at_time');
    const endAtTime = document.getElementById('end_at_time');
    const note = document.getElementById('note');

    summary.value = template.summary;
    startAtTime.value = template.startAt;
    endAtTime.value = template.endAt;
    note.value = template.note;
  }
});
