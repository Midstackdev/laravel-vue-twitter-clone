const plugin  = require('tailwindcss/plugin')

module.exports = {
  purge: [],
  theme: {
    screens: {
        'md': '640px',
        'lg': '768px',
        'md': '1024px'
    },
    extend: {
      boxShadow: {
        light: '0 0 15px 0 rgba(255, 255, 255, .1)'
      }
    },
  },
  variants: {
    textColor: ['responsive', 'hover', 'focus', 'active', 'important'],
    backgroundColor: ['responsive', 'hover', 'focus', 'active', 'important'],
    borderWidth: ['responsive', 'important'],
  },
  plugins: [
    plugin(function({ addVariant }) {
          addVariant('important', ({ container }) => {
            container.walkRules(rule => {
              rule.selector = `.\\!${rule.selector.slice(1)}`
              rule.walkDecls(decl => {
                decl.important = true
              })
            })
          })
        })
  ],
}
