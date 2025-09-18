(() => {
  "use strict";
  const { PluginSidebar: e } = wp.editPost,
    { PanelBody: l, Button: a, TabPanel: i, TextControl: t } = wp.components,
    { MediaUpload: n, MediaUploadCheck: r, RichText: c } = wp.blockEditor,
    { useSelect: s, useDispatch: o } = wp.data,
    { Fragment: d } = wp.element,
    { registerPlugin: m } = wp.plugins,
    { jsxs: g, jsx: p } = window.ReactJSXRuntime;
  m("all-galleries-sidebar", {
    render: () => {
      const m = s((e) => e("core/editor").getEditedPostAttribute("meta"), []),
        { editPost: h } = o("core/editor"),
        y = (e, l) => {
          h({ meta: { ...m, [e]: l } });
        };
      return p(e, {
        name: "all-galleries-sidebar",
        title: "Gallery Settings",
        icon: "format-gallery",
        children: p(i, {
          className: "gallery-tabs",
          activeClass: "is-active",
          tabs: [
            { key: "first_gallery", label: "First Gallery" },
            { key: "second_gallery", label: "Second Gallery" },
            { key: "third_gallery", label: "Third Gallery" },
          ].map((e) => ({ name: e.key, title: e.label })),
          children: (e) =>
            ((e) => {
              const i = m[`${e}_background`] || "",
                s = m[`${e}_title`] || "",
                o = m[`${e}_description`] || "";
              let h = [];
              try {
                h = JSON.parse(m[`${e}_images`] || "[]");
              } catch {
                h = [];
              }
              return g(d, {
                children: [
                  g(l, {
                    title: "Gallery Settings",
                    initialOpen: !0,
                    children: [
                      g("div", {
                        children: [
                          p("label", {
                            className: "block mb-2 font-semibold",
                            children: "Background Image",
                          }),
                          p(r, {
                            children: p(n, {
                              onSelect: (l) => {
                                y(`${e}_background`, l.url);
                              },
                              allowedTypes: ["image"],
                              render: ({ open: e }) =>
                                p(a, {
                                  isSecondary: !0,
                                  onClick: e,
                                  children: "Select Background Image",
                                }),
                            }),
                          }),
                          i &&
                            p("div", {
                              style: { marginTop: "10px" },
                              children: p("img", {
                                src: i,
                                style: { width: "100%" },
                                alt: "Background",
                              }),
                            }),
                        ],
                      }),
                      p("div", {
                        className: "mt-4",
                        children: p(t, {
                          label: "Gallery Title",
                          value: s,
                          onChange: (l) => y(`${e}_title`, l),
                          placeholder: "Enter gallery title",
                        }),
                      }),
                      p("div", {
                        className: "mt-4",
                        children: p(t, {
                          label: "Gallery Description",
                          value: o,
                          onChange: (l) => y(`${e}_description`, l),
                          placeholder: "Enter gallery description",
                          multiline: !0,
                          className: "components-base-control__input",
                        }),
                      }),
                    ],
                  }),
                  g(l, {
                    title: "Gallery Images",
                    initialOpen: !1,
                    children: [
                      h.length > 0
                        ? h.map((l, i) =>
                            g(
                              d,
                              {
                                children: [
                                  p("img", {
                                    src: l.url,
                                    style: {
                                      width: "100%",
                                      marginBottom: "8px",
                                    },
                                    alt: `Gallery Image ${i + 1}`,
                                  }),
                                  g("div", {
                                    className: "mb-4",
                                    children: [
                                      p("label", {
                                        className: "block mb-1 font-semibold",
                                        children: `Caption ${i + 1}`,
                                      }),
                                      p(c, {
                                        tagName: "div",
                                        value: l.caption,
                                        onChange: (l) => {
                                          const a = [...h];
                                          (a[i] = { ...a[i], caption: l }),
                                            y(`${e}_images`, JSON.stringify(a));
                                        },
                                        placeholder: "Enter caption...",
                                        multiline: !1,
                                        className:
                                          "components-base-control__input",
                                      }),
                                    ],
                                  }),
                                  p(a, {
                                    isDestructive: !0,
                                    onClick: () => {
                                      const l = h.filter((e, l) => l !== i);
                                      y(`${e}_images`, JSON.stringify(l));
                                    },
                                    className: "mb-4",
                                    children: "Delete Image",
                                  }),
                                ],
                              },
                              i
                            )
                          )
                        : p("p", { children: "No images added yet." }),
                      p(r, {
                        children: p(n, {
                          onSelect: (l) => {
                            const a = [...h, { url: l.url, caption: "" }];
                            y(`${e}_images`, JSON.stringify(a));
                          },
                          allowedTypes: ["image"],
                          render: ({ open: e }) =>
                            p(a, {
                              isSecondary: !0,
                              onClick: e,
                              children: "Add Image",
                            }),
                        }),
                      }),
                    ],
                  }),
                ],
              });
            })(e.name),
        }),
      });
    },
    icon: "format-gallery",
  });
})();
