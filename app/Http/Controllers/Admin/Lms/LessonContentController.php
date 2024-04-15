<?php

namespace App\Http\Controllers\Admin\Lms;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonContent;
use App\Services\FileTypeValidatorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LessonContentController extends Controller
{
    public readonly LessonContent $content;
    public readonly Lesson $lesson;
    public function __construct()
    {
        $this->content = new LessonContent();
        $this->lesson = new Lesson();
    }

    public function index(int $id): View
    {
        $contents = $this->content->query()
            ->where('lesson_id', $id)
            ->orderByDesc('created_at')
            ->paginate(10);
        $lesson = $this->lesson->find($id);
        return view('admin.lms.lessons.content.dashboard', compact('contents', 'lesson'));
    }

    public function create(int $id): View
    {
        $lesson = $this->lesson->find($id);
        return view('admin.lms.lessons.content.partials.create', compact('lesson'));
    }

    public function store(Request $request, FileTypeValidatorService $fileTypeValidator): RedirectResponse
    {
        $lesson = $this->lesson->findOrFail($request->lesson_id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'is_main' => 'required|boolean',
            'content_type' => 'required|string',
            'content_path' => function ($attribute, $value, $fail) use ($request, $fileTypeValidator) {
                $file = $request->file($attribute);
                if ($request->content_type == 'mp4' && !$fileTypeValidator->isValidVideo($file)) {
                    $fail('O arquivo enviado deve ser um vídeo MP4.');
                } elseif ($request->content_type == 'doc' && !$fileTypeValidator->isValidDoc($file)) {
                    $fail('O arquivo enviado deve ser um documento DOC/DOCX.');
                } elseif ($request->content_type == 'pdf' && !$fileTypeValidator->isValidPdf($file)) {
                    $fail('O arquivo enviado deve ser um PDF.');
                } elseif ($request->content_type == 'ppt' && !$fileTypeValidator->isValidPpt($file)) {
                    $fail('O arquivo enviado deve ser uma apresentação PPT/PPTX.');
                } elseif ($request->content_type == 'xls' && !$fileTypeValidator->isValidXls($file)) {
                    $fail('O arquivo enviado deve ser uma planilha XLS/XLSX.');
                } elseif ($request->content_type == 'cartela' && !$fileTypeValidator->isValidDoc($file)) {
                    $fail('O arquivo enviado deve ser um documento DOC/DOCX.');
                }
            },
            'description' => 'required|string',
        ],[
            'title.required' => 'O campo título é obrigatório.',
            'title.string' => 'O campo título deve ser uma string.',
            'title.max' => 'O campo título deve ter no máximo 255 caracteres.',
            'is_main.required' => 'O campo principal é obrigatório.',
            'is_main.boolean' => 'O campo principal deve ser um booleano.',
            'content_type.required' => 'O campo tipo de conteúdo é obrigatório.',
            'content_type.string' => 'O campo tipo de conteúdo deve ser uma string.',
            'content_path.required' => 'O campo arquivo é obrigatório.',
            'content_path.file' => 'O arquivo enviado deve ser um arquivo válido.',
            'content_path.mimes' => 'O arquivo enviado deve ser um arquivo válido.',
            'content_path.max' => 'O arquivo enviado deve ter no máximo 2MB.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma string.',
        ]);

        if ($request->hasFile('content_path')) {
            $file = $request->file('content_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lms/lessons/'. $lesson->code .'/contents' , $fileName);
            $validatedData['content_path'] = $fileName;
        }

        $validatedData['lesson_id'] = $request->lesson_id;
        $this->content->create($validatedData);

        return redirect()->route('admin.lms.lessons.show', ['id' => $request->lesson_id])->with('success', 'Conteúdo criado com sucesso.');
    }

    public function show(int $lessonId, int $contentId): View
    {
        $lesson = $this->lesson->findOrFail($lessonId);
        $content = $this->content->findOrFail($contentId);
        return view('admin.lms.lessons.content.partials.show', compact('content', 'lesson'));
    }

    public function edit(int $lessonId, int $contentId): View
    {
        $lesson = $this->lesson->findOrFail($lessonId);
        $content = $this->content->findOrFail($contentId);
        return view('admin.lms.lessons.content.partials.edit', compact('content', 'lesson'));
    }

    public function update(Request $request, int $lessonId, int $contentId, FileTypeValidatorService $fileTypeValidator): RedirectResponse
    {
        $content = $this->content->findOrFail($contentId);
        $lesson = $this->lesson->findOrFail($lessonId);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'is_main' => 'required|boolean',
            'content_type' => 'required|string',
            'content_path' => function ($attribute, $value, $fail) use ($request, $fileTypeValidator) {
                if ($request->hasFile($attribute)) {
                    $file = $request->file($attribute);
                    if ($request->content_type === 'mp4' && !$fileTypeValidator->isValidVideo($file)) {
                        $fail('O arquivo enviado deve ser um vídeo MP4.');
                    } elseif ($request->content_type === 'doc' && !$fileTypeValidator->isValidDoc($file)) {
                        $fail('O arquivo enviado deve ser um documento DOC/DOCX.');
                    } elseif ($request->content_type === 'pdf' && !$fileTypeValidator->isValidPdf($file)) {
                        $fail('O arquivo enviado deve ser um PDF.');
                    } elseif ($request->content_type === 'ppt' && !$fileTypeValidator->isValidPpt($file)) {
                        $fail('O arquivo enviado deve ser uma apresentação PPT/PPTX.');
                    } elseif ($request->content_type === 'xls' && !$fileTypeValidator->isValidXls($file)) {
                        $fail('O arquivo enviado deve ser uma planilha XLS/XLSX.');
                    } elseif ($request->content_type === 'cartela' && !$fileTypeValidator->isValidDoc($file)) {
                        $fail('O arquivo enviado deve ser um documento DOC/DOCX.');
                    }
                }
            },
            'description' => 'required|string',
        ]);

        if ($request->lesson_code !== $lesson->code) {
            if ($content->content_path) {
                Storage::move('public/lms/lessons/' . $lesson->code . '/contents/' . $content->content_path, 'public/lms/lessons/' . $request->lesson_code . '/contents/' . $content->content_path);
            }
        }

        if ($request->hasFile('content_path')) {
            if ($content->content_path) {
                Storage::delete('public/lms/lessons/' . $lesson->code . '/contents/' . $content->content_path);
            }
            $file = $request->file('content_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/lms/lessons/'. $lesson->code .'/contents' , $fileName);;
            $validatedData['content_path'] = $fileName;
        }

        $content->update($validatedData);

        return redirect()->route('admin.lms.lessons.show', ['id' => $lesson->id])->with('success', 'Conteúdo atualizado com sucesso.');
    }

    public function destroy(int $lessonId, int $contentId): RedirectResponse
    {
        $content = $this->content->findOrFail($contentId);
        $lesson = $this->lesson->findOrFail($lessonId);
        if ($content->content_path) {
            Storage::delete('public/lms/lessons/' . $lesson->code . '/contents/' . $content->content_path);
        }

        $content->delete();
        return redirect()->route('admin.lms.lessons.show', ['id' => $lessonId])->with('success', 'Conteúdo excluído com sucesso.');
    }
}
