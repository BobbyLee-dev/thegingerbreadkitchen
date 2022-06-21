import { MediaUpload } from '@wordpress/block-editor';
import MediaUploadNoImage from './MediaUploadNoImage';
import MediaUploadWithImage from './MediaUploadWithImage';

const AdminImage = ({
	openMedia,
	setAttributes,
	image,
	imageID,
	attributes,
}) => {
	function selectImage(media) {
		setAttributes({ image: media.sizes.full.url });
		setAttributes({ imageID: media.id });
		console.log(attributes);
	}

	return (
		<MediaUpload
			allowedTypes={['image']}
			onSelect={selectImage}
			value={imageID}
			render={({ open }) => {
				return (
					<div className="image-wrap">
						{console.log(image)}
						{image ? (
							<MediaUploadWithImage
								image={image}
								openMedia={open}
								setAttributes={setAttributes}
							/>
						) : (
							<MediaUploadNoImage openMedia={open} />
						)}
					</div>
				);
			}}
		/>
	);
};

export default AdminImage;
