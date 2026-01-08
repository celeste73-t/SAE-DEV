-- Recupérer les proposition

SELECT itemId, COUNT(*) AS nb
FROM proposition
WHERE categorieId = ?
GROUP BY itemId
ORDER BY nb DESC
LIMIT 5;


-- Récupérer les résultats

SELECT propositionId, COUNT(*) AS nbVotes
FROM proposition_vote
GROUP BY propositionId;
