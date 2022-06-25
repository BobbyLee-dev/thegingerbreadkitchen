import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';
import AdminButton from '../components/AdminButton';
import AdminImage from '../components/AdminImage';

const Edit = ({ attributes, setAttributes }) => {
	const blockProps = useBlockProps({
		className: 'split-image-content',
	});

	return (
		<section {...blockProps}>
			<div class="wrapper">
				<AdminImage
					imageID={attributes.imageID}
					image={attributes.image}
					setAttributes={setAttributes}
				/>
				<div class="block-content-wrap">
					<RichText
						allowedFormats={[]}
						className="block-heading"
						value={attributes.heading}
						onChange={(text) => setAttributes({ heading: text })}
						placeholder="Heading"
						tagName="h2"
					/>
					<RichText
						className="block-text"
						value={attributes.content}
						onChange={(text) => {
							setAttributes({ content: text });
							console.log(attributes);
						}}
						placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
						tagName="div"
						multiline="p"
					/>
					<AdminButton
						buttonText={attributes.buttonText}
						linkObject={attributes.linkObject}
						setAttributes={setAttributes}
					/>
				</div>
			</div>
		</section>
	);
};

export default Edit;
