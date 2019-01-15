import app from 'flarum/app';

import RedisSessionSettingsModal from './components/RedisSessionSettingsModal';

app.initializers.add('pixelfederation-ext-redis-session', () => {
  app.extensionSettings['pixelfederation-redis-session'] = () => app.modal.show(new RedisSessionSettingsModal());
});
