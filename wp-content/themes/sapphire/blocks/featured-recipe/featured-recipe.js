import { useSelect } from '@wordpress/data';
import { useState } from '@wordpress/element';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import AdminButton from '../components/AdminButton';
import AdminImage from '../components/AdminImage';

wp.blocks.registerBlockType('sapphiretheme/featured-recipe', {
	title: 'Sapphire Featured Recipe',
	description: 'Add a new recipe',
	icon: 'dashicons-food',
	category: 'common',
	attributes: {
		recipeId: { type: 'string' },
		align: {
			type: 'string',
			default: 'full',
		},
		postData: {
			type: 'array',
			default: [],
		},
		image: {
			type: 'string',
			default: '',
		},
		imageID: {
			type: 'number',
		},
		heading: {
			type: 'string',
			default: '',
		},
		content: {
			type: 'string',
			default: '',
		},
		buttonText: {
			type: 'string',
			default: '',
		},
		linkObject: {
			type: 'object',
			default: {
				url: '',
			},
		},
	},
	edit: EditComponent,
	save: function () {
		return null;
	},
});

function EditComponent(props) {
	const { attributes, setAttributes } = props;
	const allRecipes = useSelect((select) => {
		return select('core').getEntityRecords('postType', 'recipe', {
			per_page: -1,
		});
	});

	useSelect((select) => {
		const featuredRecipeData = select('core').getEntityRecords(
			'postType',
			'recipe',
			{
				include: attributes.recipeId,
			}
		);
		if (featuredRecipeData) {
			setAttributes({ postData: featuredRecipeData });
		}
	});
	console.log(attributes.postData[0]);

	if (allRecipes == undefined) return <p>Loading...</p>;

	return (
		<div className="featured-recipe">
			<div className="">
				<select
					onChange={(e) =>
						setAttributes({ recipeId: e.target.value })
					}
				>
					<option value="">Select a Recipe</option>
					{allRecipes.map((recipe) => {
						return (
							<option
								key={recipe.id}
								value={recipe.id}
								selected={attributes.recipeId == recipe.id}
							>
								{recipe.title.rendered}
							</option>
						);
					})}
				</select>
			</div>
			{Array.isArray(attributes.postData) &&
			attributes.postData.length ? (
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
							// value={attributes.heading}
							value={attributes.postData[0].title.rendered}
							onChange={(text) =>
								setAttributes({ heading: text })
							}
							placeholder="Heading"
							tagName="h2"
						/>
						<RichText
							className="block-text"
							value={attributes.content}
							onChange={(text) => {
								setAttributes({ content: text });
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
			) : (
				'lol'
			)}
		</div>
	);
}
