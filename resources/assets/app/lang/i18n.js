import Vue from 'vue';
import VueI18n from 'vue-i18n';
import messages from './en';

Vue.use(VueI18n);

export default new VueI18n({
  locale:   'en',
  messages: { en: messages },
});