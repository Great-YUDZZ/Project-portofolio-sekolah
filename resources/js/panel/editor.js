import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Link from '@tiptap/extension-link';
import Image from '@tiptap/extension-image';
import Placeholder from '@tiptap/extension-placeholder';

export function initTiptapEditor() {
    const editorElement = document.getElementById('tiptap-editor');
    const hiddenInput = document.getElementById('post-content-hidden');

    if (!editorElement || !hiddenInput) {
        return;
    }

    const initialContent = hiddenInput.value || '';

    const editor = new Editor({
        element: editorElement,
        extensions: [
            StarterKit.configure({
                heading: {
                    levels: [2, 3, 4],
                },
            }),
            Link.configure({
                openOnClick: false,
                HTMLAttributes: {
                    class: 'text-amber-600 underline font-semibold hover:text-amber-700',
                },
            }),
            Image.configure({
                inline: false,
                HTMLAttributes: {
                    class: 'rounded-xl max-w-full my-4 shadow-sm border border-slate-200',
                },
            }),
            Placeholder.configure({
                placeholder: 'Tuliskan isi berita atau pengumuman secara mendalam di sini...',
            }),
        ],
        content: initialContent,
        editorProps: {
            attributes: {
                class: 'prose prose-slate max-w-none focus:outline-none min-h-[320px] p-4 text-slate-800 leading-relaxed font-sans',
            },
        },
        onUpdate({ editor }) {
            hiddenInput.value = editor.getHTML();
        },
    });

    // Toolbar button interactions
    const toolbar = document.getElementById('tiptap-toolbar');
    if (!toolbar) return;

    toolbar.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-tiptap-cmd]');
        if (!btn) return;
        e.preventDefault();

        const cmd = btn.getAttribute('data-tiptap-cmd');
        const level = parseInt(btn.getAttribute('data-tiptap-level') || '0', 10);

        switch (cmd) {
            case 'bold':
                editor.chain().focus().toggleBold().run();
                break;
            case 'italic':
                editor.chain().focus().toggleItalic().run();
                break;
            case 'strike':
                editor.chain().focus().toggleStrike().run();
                break;
            case 'heading':
                editor.chain().focus().toggleHeading({ level }).run();
                break;
            case 'bulletList':
                editor.chain().focus().toggleBulletList().run();
                break;
            case 'orderedList':
                editor.chain().focus().toggleOrderedList().run();
                break;
            case 'blockquote':
                editor.chain().focus().toggleBlockquote().run();
                break;
            case 'horizontalRule':
                editor.chain().focus().setHorizontalRule().run();
                break;
            case 'undo':
                editor.chain().focus().undo().run();
                break;
            case 'redo':
                editor.chain().focus().redo().run();
                break;
            case 'link': {
                const prev = editor.getAttributes('link').href || '';
                const url = window.prompt('Masukkan tautan URL (contoh: https://smkn1denpasar.sch.id):', prev);
                if (url === null) return;
                if (url === '') {
                    editor.chain().focus().unsetLink().run();
                } else {
                    editor.chain().focus().setLink({ href: url }).run();
                }
                break;
            }
            case 'image-upload': {
                const fileInput = document.getElementById('tiptap-image-input');
                fileInput?.click();
                break;
            }
            default:
                break;
        }

        updateToolbarState(editor, toolbar);
    });

    // Handle Image file upload via AJAX
    const fileInput = document.getElementById('tiptap-image-input');
    if (fileInput) {
        fileInput.addEventListener('change', async () => {
            const file = fileInput.files?.[0];
            if (!file) return;

            const uploadUrl = fileInput.getAttribute('data-upload-url') || '/admin/media/upload';
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            const formData = new FormData();
            formData.append('image', file);

            const uploadBtn = document.querySelector('[data-tiptap-cmd="image-upload"]');
            if (uploadBtn) {
                uploadBtn.classList.add('animate-pulse', 'opacity-50');
            }

            try {
                const response = await fetch(uploadUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                if (!response.ok) {
                    const err = await response.json();
                    throw new Error(err.message || 'Gagal mengunggah gambar');
                }

                const data = await response.json();
                if (data.url) {
                    editor.chain().focus().setImage({ src: data.url, alt: data.name || '' }).run();
                }
            } catch (err) {
                alert('Unggah gambar gagal: ' + (err.message || 'Terjadi kesalahan sistem'));
            } finally {
                fileInput.value = '';
                if (uploadBtn) {
                    uploadBtn.classList.remove('animate-pulse', 'opacity-50');
                }
            }
        });
    }

    editor.on('selectionUpdate', () => updateToolbarState(editor, toolbar));
}

function updateToolbarState(editor, toolbar) {
    const buttons = toolbar.querySelectorAll('[data-tiptap-cmd]');
    buttons.forEach((btn) => {
        const cmd = btn.getAttribute('data-tiptap-cmd');
        const level = parseInt(btn.getAttribute('data-tiptap-level') || '0', 10);

        let isActive = false;
        if (cmd === 'heading') {
            isActive = editor.isActive('heading', { level });
        } else if (['bold', 'italic', 'strike', 'bulletList', 'orderedList', 'blockquote', 'link'].includes(cmd)) {
            isActive = editor.isActive(cmd);
        }

        if (isActive) {
            btn.classList.add('bg-slate-900', 'text-white');
            btn.classList.remove('bg-white', 'text-slate-700', 'hover:bg-slate-100');
        } else {
            btn.classList.remove('bg-slate-900', 'text-white');
            btn.classList.add('bg-white', 'text-slate-700', 'hover:bg-slate-100');
        }
    });
}
