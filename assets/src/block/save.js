import { useBlockProps } from '@wordpress/block-editor';
import { blockIcon, blockStyle } from './index';

export const Save = ( { attributes } ) => {
	return (
		<div { ...useBlockProps.save( { style: { ...blockStyle } } ) }>
			{ blockIcon }
			<h4>
				<a href={ attributes.href } className={ 'has-link-color' }>
					Hello World, WordPress Plugin Boilerplate Powered here!
				</a>
			</h4>
		</div>
	);
};
