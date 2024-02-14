import { registerReactControllerComponents } from '@symfony/ux-react';
import './bootstrap';

registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));