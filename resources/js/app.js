import './bootstrap';

document.getElementById('theme-toggle').addEventListener('click', () => {
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

document.getElementById('reservation-delete-button').addEventListener('click', event => {
  event.preventDefault();

  if (confirm('削除します。よろしいですか？')) {
    document.getElementById('reservation-delete-form').submit();
  }
});
