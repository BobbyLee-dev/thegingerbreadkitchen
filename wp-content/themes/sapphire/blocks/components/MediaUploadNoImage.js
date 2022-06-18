/**
 * WordPress dependencies
 */
import { MediaUploadCheck } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Vendor dependencies
 */
import PropTypes from 'prop-types';

/**
 * Media upload with no image
 */
const MediaUploadNoImage = ({ openMedia }) => {
	return (
		<MediaUploadCheck>
			<div className="form-logo-wrap">
				<Button isPrimary onClick={openMedia}>
					{__('Select an Image', 'donation-form')}
				</Button>
			</div>
		</MediaUploadCheck>
	);
};

MediaUploadNoImage.PropTypes = {
	openMedia: PropTypes.func,
};

export default MediaUploadNoImage;
