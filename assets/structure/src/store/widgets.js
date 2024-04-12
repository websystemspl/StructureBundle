import { reactive } from 'vue'

export const widgetStore = reactive({
  widgets: [
    {
        uid: null,
        name: 'Text',
        icon: 'bi bi-textarea-t',
        settings: {
          Padding: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Margin: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Background: "",
          Color: "",
          Align: 'left',
        },
        component: 'TextBlock',
        content: 'This is a text block',
    },
    {
        uid: null,
        name: 'Header',
        icon: 'bi bi-type-h1',
        settings: {
          Padding: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Margin: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Background: "",
          Color: "",
          Align: 'left',
        },
        component: 'HeaderBlock',
        content: 'This is a header block',
        style: 'h1',
    },
    {
        uid: null,
        name: 'Columns',
        icon: 'bi bi-layout-three-columns',
        settings: {
          Padding: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Margin: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Background: "",
        },
        component: 'ColumnBlock',
        columns: [],
        columnsCount: 2,
    },
    {
        uid: null,
        name: 'Section',
        icon: 'bi bi-aspect-ratio',
        settings: {
          Padding: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Margin: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Background: "",
          Container: false,
        },
        component: 'SectionBlock',
        blocks: [],
    },
    {
        uid: null,
        name: 'Image',
        icon: 'bi bi-image',
        settings: {
          Padding: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Margin: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Background: "",
          Align: 'left',
          Width: '100%',
        },
        component: 'ImageBlock',
        src: 'https://neonet.id/assets/images/slider/default.jpg',
    },
    {
        uid: null,
        name: 'Twig Block',
        icon: 'bi bi-braces',
        settings: {
          Padding: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
          Margin: {
            top: "",
            right: "",
            bottom: "",
            left: "",
          },
        },
        component: 'TwigBlock',
        block: "",
    }
  ],
})