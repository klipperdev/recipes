import {I18nModuleState} from '@klipper/bow/stores/i18n/I18nModuleState';
import {DarkModeModuleState} from '@klipper/bow/stores/darkMode/DarkModeModuleState';
import {DrawerModuleState} from '@klipper/bow/stores/drawer/DrawerModuleState';
import {AuthModuleState} from '@klipper/bow/stores/auth/AuthModuleState';

export interface RootState extends
    DarkModeModuleState,
    DrawerModuleState,
    AuthModuleState,
    I18nModuleState {
}
