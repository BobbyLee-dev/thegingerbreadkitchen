import { useBlockProps } from '@wordpress/block-editor';
import AdminImage from '../components/AdminImage';

const Edit = ({ attributes, setAttributes }) => {
	const blockProps = useBlockProps({
		className: 'split-image-content',
	});

	return (
		<section {...blockProps}>
			<AdminImage
				imageID={attributes.imageID}
				image={attributes.image}
				setAttributes={setAttributes}
			/>
			<div class="">Hi my name is Sofya</div>
		</section>
	);
};

export default Edit;
