
import { localize } from '@vee-validate/i18n';
import es from '@vee-validate/i18n/dist/locale/es.json';

import * as AllRules from '@vee-validate/rules';
import { configure, defineRule } from 'vee-validate';

Object.entries(AllRules).forEach(([key, value]) => {
	if(key === 'default') return;
	defineRule(key, value);
});

localize({ es });

configure({
	generateMessage: localize('es'),
});