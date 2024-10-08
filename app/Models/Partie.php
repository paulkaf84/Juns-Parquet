<?php /** @noinspection ALL */

namespace App\Models;

use App\Enums\PartieGender;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'nom',
        'post_nom',
        'prenom',
        'adresse',
        'sexe',
        'tel',
        'origine',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * @return array
     */
    public static function getForm(): array
    {
        return [
            TextInput::make('nom')
                ->required(),
            TextInput::make('post_nom')
                ->nullable(),
            TextInput::make('prenom')
                ->nullable(),
            TextInput::make('adresse')
                ->nullable(),
            Select::make('sexe')
                ->enum(PartieGender::class)
                ->options(PartieGender::class)
                ->required(),
            TextInput::make('tel')
                ->tel()
                ->nullable(),
            TextInput::make('origine')
                ->nullable(),
        ];
    }

    public function plaintes(): HasMany
    {
        return $this->hasMany(Plainte::class);
    }

    public function partieAsPlaignants(): HasMany
    {
        return $this->hasMany(Plainte::class, 'plaignant_id');
    }
    public function partieAsAccuse(): HasMany
    {
        return $this->hasMany(Plainte::class, 'accusee_id');
    }
}
